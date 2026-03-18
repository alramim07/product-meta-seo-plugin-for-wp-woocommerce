# Eazyproo Product Meta

**Contributors:** TIC LTD, Al Ramim  
**Tags:** woocommerce, product meta, custom tabs, specifications, requirements, software specs  
**Requires at least:** 6.0  
**Requires PHP:** 8.0  
**License:** GPLv2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html  

Eazyproo Product Meta is a standalone WordPress plugin for WooCommerce that adds rich, customizable meta tabs and product data sections like Overview, System Requirements, Included Apps, and Key Features to your single product pages.

---

## 🚀 What is this plugin?

Eazyproo Product Meta was specifically designed to enhance WooCommerce product pages by allowing store administrators to display detailed software/hardware specifications, essential features, and comprehensive overviews in a beautiful, structured format. 

Originally built as a custom integration for a specific child theme, it has been fully extracted into a standalone, universal plugin that works seamlessly with any modern WordPress theme.

## 💡 Why is it useful?

By default, WooCommerce only provides a basic "Description" and "Additional Information" tab to describe products. For digital goods, software licenses, or complex electronics, customers need structured data like exact system requirements, compatible applications, platforms, and standout key features. 

Eazyproo solves this by providing:
1. **A Global Settings Dashboard (`WP Admin > Eazyproo`):** Where you can pre-define global data points (e.g., icons, titles, platforms like "Windows", "Adobe", "macOS").
2. **A Product-Level Selector:** Where shop managers can seamlessly check off which preset specs/apps apply to the specific product they are editing via the WooCommerce product data panel.
3. **Beautiful Front-End Rendering:** Automatically hooking into the WooCommerce single product layout to inject these specifications so customers see highly organized, easy-to-read panels instead of chaotic text descriptions.

## ⚙️ How it works

1. **Global Database Tables:** The plugin automatically creates dedicated, lightweight database tables (`tic_meta_overview`, `tic_meta_sys_reqs`, `tic_meta_apps`, `tic_key_features`) to store your global definitions efficiently. 
2. **Admin Configuration:** Under the **Eazyproo** menu in your WordPress dashboard, you can define your universal "Overview" tags, "System Requirements", "Meta Fields", and "Apps" dictionaries. You can upload custom icons or images for each.
3. **Per-Product Assignment:** When editing a WooCommerce product, custom Eazyproo tabs will appear inside the product data meta box. You can quickly select and apply the global features to the individual product.
4. **Front-End Hooks:** The plugin uses standard WooCommerce ecosystem hooks (like `woocommerce_product_tabs` and `woocommerce_single_product_summary`) to dynamically render your selected specifications exactly where they belong on the frontend product page.

## ✨ Key Features

* **Global Preset Management:** Create specs and icons once, use them across hundreds of products instantly.
* **Overview Section:** Highlight high-level categories, platforms, or versions.
* **System Requirements Builder:** Detail OS, RAM, Storage, and CPU requirements cleanly.
* **Included Apps Picker:** Visually show which software programs (with thumbnail icons) are included in a bundle or license.
* **Key Features List:** Display bulleted standout capabilities accompanied by FontAwesome icons.
* **Dynamic Payment Icons:** Automatically displays fallback icons for available WooCommerce payment gateways in the secure checkout notice.
* **Universal Theme Compatibility:** Built with standard WP functions to ensure compatibility across different themes.

## 🛠️ Installation & Setup

1. Upload the entire `eazyproo-product-meta` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Once activated, navigate to the **Eazyproo** menu item in the left-hand admin sidebar.
4. Configure your global meta fields, titles, and icons inside the 6 settings tabs (**Eazyproo -> Settings**).
5. Edit any WooCommerce product, find the new Eazyproo tabs injected into the product data box, and start assigning specs!

## 👨‍💻 Developer Information

* **Developed by:** Al Ramim ([@lynsromero](https://github.com/lynsromero))
* **Author Company:** [TIC LTD](https://tic.com.bd/)
