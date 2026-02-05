/*
 * Author: Floydian
 * License: Free to use and modify however you want. Please keep this comment block in the script.
 * Web site: www.phphorizons.com
 */

(function () {
	var Dom = YAHOO.util.Dom,
		Event = YAHOO.util.Event,
		Lang = YAHOO.lang,
		Button = YAHOO.widget.Button;
	
	YAHOO.widget.ButtonWrapper = {
		createSelectButton: function (el, buttonConfigs, menuConfigs) {
			var button = Dom.get(el),
			label = button.value,
			menu = Dom.getNextSibling(button),
			menuItems,
			menuItemCount = 0,
			defaultItem = null,
			buttonConfigs = buttonConfigs || {},
			menuConfigs = menuConfigs || {};

			if (!menu || menu.nodeName !== 'SELECT') {
				return new YAHOO.widget.Button(button, {type: 'push', disabled: true, label: 'No menu found'});
			}
			
			menuItems = Dom.getChildren(menu);
			Dom.batch(menuItems, function (el) {
				if (el.nodeName === 'OPTION') {
					var elSelected = el.getAttribute('selected'),
					elDisabled = el.getAttribute('disabled');
					
					if (elSelected || elSelected === '') {
						label = el.innerHTML;
					}
					if (elDisabled || elDisabled === '') {
						defaultItem = menuItemCount;
					}
					
					menuItemCount = menuItemCount + 1;
				}
			});
			
			// menu = new YAHOO.widget.Menu(menu, menuConfigs);
			// if (Lang.isNumber(defaultItem) === true) {
			// 	menuItems = menu.getItems();
			// 	menuItems[defaultItem].cfg.setProperty('disabled', true);
			// }
			// menu.render(document.body);
			
			buttonConfigs.type = 'menu';
			buttonConfigs.label = label;
			buttonConfigs.menu = menu;
			
			button = new Button(button, buttonConfigs);
			
			if (Lang.isNumber(defaultItem) === true) {

				button.getMenu().subscribe("render", function (type, args, defaultItemIndex) {

					menuItems = menu.getItems();
					menuItems[defaultItemIndex].cfg.setProperty('disabled', true);

				}, defaultItem);

			}

			//	NOTE: 
			//	1) Menu doesn't have a "minheight" configuration property
			//	2) Button provides a "menuminscrollheight" attribute that you 
			//	can use to set the "minscrollheight" property on its 
			//	corresponding Menu instance.
			
			// if (menuConfigs.minheight) {
			// 	menu.cfg.setProperty('minheight', menuConfigs.minheight);
			// }
			// if (menuConfigs.minscrollheight) {
			// 	menu.cfg.setProperty('minscrollheight', menuConfigs.minscrollheight);
			// }
			
			button.on('beforeSelectedMenuItemChange', function (event) {
				if (event.newValue.cfg.getProperty("disabled") === true) {
					return false;
				}
			} );
			
			// menu.subscribe('click', function (e, o) {
			// 	if (o[1] && o[1].cfg.getProperty("disabled") !== true) {
			// 		button.set("label", ("<em class=\"yui-button-label\">" + o[1].cfg.getProperty("text") + "</em>"));
			// 	}
			// });

			button.getMenu().subscribe('click', function (e, o) {
				if (o[1] && o[1].cfg.getProperty("disabled") !== true) {
					button.set("label", ("<em class=\"yui-button-label\">" + o[1].cfg.getProperty("text") + "</em>"));
				}
			});

			return button;
		},
		
		createToggleButton: function (el, buttonConfigs) {
			var button = Dom.get(el),
				label = button.value || 'No|Yes',
				buttonConfigs = buttonConfigs || {},
				isChecked = button.getAttribute('checked');
			
			label = label.split('|');
			label[0] = label[0] || 'No';
			label[1] = label[1] || 'Yes';
			
			
			if (isChecked || isChecked === '') {
				buttonConfigs.checked = true;
				buttonConfigs.label = label[1];
				buttonConfigs.value = 'on';
			} else {
				buttonConfigs.checked = false;
				buttonConfigs.label = label[0];
				buttonConfigs.value = '';
			}
			
			buttonConfigs.type = buttonConfigs.type || 'checkbox';
			
			button = new Button(button, buttonConfigs);
			button.on('click', function() {
				if (this.get('value') === '') {
					this.set('value', 'on');
					this.set('label', label[1]);
				} else {
					this.set('value', '');
					this.set('label', label[0]);
				}
			});
			
			return button;
		},
		
		createTextInput: function (inputEl, config) {
			var method,
				offset,
				x_position = ' -1px'
				y_position =  445;
			
			config = config || {};
			config.inputEl = Dom.get(inputEl);
			if (!config.inputEl) {
				return null;
			}
			config.container = config.container || null;
			config.container = Dom.get(config.container);
			config.value = config.origValue = config.inputEl.value;
			config.width = config.width || config.inputEl.style.width;
			config.isDark = config.isDark || false;
			config.noWatermark = config.noWatermark || false;
			
			config.width = parseInt(config.width, 10);
			
			if (Dom.hasClass(config.inputEl, 'yui-text-input-no-watermark')) {
				config.noWatermark = true;
			}
			if (Dom.hasClass(config.inputEl, 'yui-text-input-dark')) {
				Dom.removeClass(config.inputEl, 'yui-text-input-dark');
				config.isDark = true;
			}
			
			
			if (!config.container) {
				config.container = document.createElement('DIV');
				Dom.insertBefore(config.container, config.inputEl);
				config.container.appendChild(config.inputEl);
			} else {
				method = function (el) { return el.nodeName === 'INPUT'; };
				if (!Dom.getFirstChildBy(config.container, method)) {
					config.container.appendChild(config.inputEl);
				}
			}
			
			if (!Dom.hasClass(config.container, 'yui-text-input') ) {
				Dom.addClass(config.container, 'yui-text-input');
			}
			if (config.isDark) {
				Dom.addClass(config.container, 'yui-text-input-dark');
				x_position = ' -32px'
			}
			
			
			if (!Dom.hasClass(config.inputEl, 'yui-text-input-watermark') && !config.noWatermark ) {
				Dom.addClass(config.inputEl, 'yui-text-input-watermark');
			}
			
			if (config.width && config.width !== 160) {
				if (config.width < 160) {
					offset = 160 - config.width;
					Dom.setStyle(config.inputEl, 'width', (160 - offset) + 'px');
					Dom.setStyle(config.container, 'width', (163 - offset) + 'px');
					Dom.setStyle(config.container, 'background-position', '-' + (y_position + offset) + 'px' + x_position);
				} else {
					offset = config.width - 160;
					Dom.setStyle(config.inputEl, 'width', (160 + offset) + 'px');
					Dom.setStyle(config.container, 'width', (163 + offset) + 'px');
					Dom.setStyle(config.container, 'background-position', '-' + (y_position - offset) + 'px' + x_position);
				}
			}
			
			if (!config.noWatermark) {
				Event.on(config.inputEl, 'focus', function (e) {
					if (config.inputEl.value === config.origValue) {
						config.inputEl.value = '';
						Dom.removeClass(config.inputEl, 'yui-text-input-watermark');
					}
				});
				Event.on(config.inputEl, 'blur', function (e) {
					if (config.inputEl.value === '') {
						config.inputEl.value = config.origValue;
						Dom.addClass(config.inputEl, 'yui-text-input-watermark');
					}
				});
			}
			
		}
	};
	
}());



