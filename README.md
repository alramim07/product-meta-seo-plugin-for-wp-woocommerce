# Eazyproo Product Meta & Specification Engine for WooCommerce

[![WordPress](https://img.shields.io/badge/WordPress-%3E%3D6.0-21759B?style=for-the-badge&logo=wordpress&logoColor=white)](https://wordpress.org)
[![WooCommerce](https://img.shields.io/badge/WooCommerce-%3E%3D7.0-96588A?style=for-the-badge&logo=woocommerce&logoColor=white)](https://woocommerce.com)
[![PHP](https://img.shields.io/badge/PHP-%3E%3D8.0-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![Version](https://img.shields.io/badge/Version-1.1.7-brightgreen?style=for-the-badge)]()
[![License](https://img.shields.io/badge/License-GPL--2.0%2B-blue?style=for-the-badge)]()

An extensible **Product Meta Data, Technical Specifications, and SEO Rich-Content Engine** for **WooCommerce**. Engineered to eliminate chaotic plaintext product descriptions by providing structured admin data panels and front-end tabs for software requirements, hardware specifications, included software suites, feature matrix comparisons, delivery notices, and dynamic FAQ accordions.

---

## 🏛️ System Architecture & Hook Lifecycle

```mermaid
flowchart TD
    subgraph Admin_Layer["🏢 WordPress Admin Experience"]
        GLOBAL["Global Settings Panel (`WP Admin > Eazyproo`)"]
        PRODUCT["WooCommerce Product Edit Meta Box"]
        TABS["Custom Data Panels (9 Specialized Tabs)"]
    end

    subgraph Core_Engine["⚙️ Plugin Kernel (`eazyproo-product-meta`)"]
        FILTER["`woocommerce_product_data_tabs` Hook"]
        SAVE["`woocommerce_process_product_meta` Sanitizer"]
        RENDER["Front-end Tab Injector (`woocommerce_product_tabs`)"]
    end

    subgraph Storefront["🛍️ Single Product Presentation"]
        FRONT_TABS["Overview & Highlights Tab"]
        SPECS["OS & Hardware System Requirements"]
        APPS["Included Applications & Addons"]
        FAQ["Product FAQ Accordion"]
        NOTICE["Instant Delivery Notice"]
    end

    GLOBAL --> PRODUCT
    PRODUCT --> TABS
    TABS --> FILTER
    FILTER --> SAVE
    SAVE --> RENDER
    RENDER --> Storefront
```

---

## 🌟 Core Functional Capabilities

### 1. 🗂️ 9 Modular Product Specification Panels
Injected cleanly into WooCommerce's core `product_data` metabox:
- **Product Overview:** Highlighted bullet points, warranty details, and quick specs.
- **System Requirements:** Structured minimum vs. recommended hardware/OS specifications (CPU, RAM, GPU, OS platform compatibility).
- **Included Applications:** Vector/icon catalog linking bundled software suites (e.g., Office packages, Creative Cloud apps).
- **Key Features:** Matrix of standout product features with icon associations.
- **Dynamic Product FAQs:** Product-specific Q&A accordions rendered with structured schema semantics.
- **Title Tag & SEO Overrides:** Granular control over technical specifications titles.
- **Instant Delivery Notices:** Digital fulfillment disclaimers (e.g., "Instant Email Delivery within 5 Minutes").
- **Important Buyer Notices:** Advisory warnings, activation disclaimers, and compatibility notices.
- **Custom Meta Contents:** Free-form technical attribute pairings.

### 2. 🎛️ Two-Tier Administration (Global Presets vs. Product Overrides)
- **Centralized Presets (`WP Admin > Eazyproo`):** Define standard platforms (Windows, macOS, Android, iOS), hardware architectures, and icons once globally.
- **One-Click Product Binding:** Shop managers check off pre-configured presets when editing products without retyping technical details repeatedly.

### 3. ⚡ Optimized Asset Delivery
- Asset scripts and stylesheets (`admin-style.css`, `admin-script.js`) are scoped strictly to `post_type === 'product'`, ensuring zero admin bloat on unrelated screens.
- Clean front-end CSS respecting active theme typography and responsive breakpoints.

---

## 🛠️ Technology Stack & Requirements

| Layer | Specifications |
|---|---|
| **Platform** | WordPress 6.0+ (Tested up to 6.7+) |
| **E-Commerce** | WooCommerce 7.0+ (Compatible with Classic & Block Single Product Templates) |
| **Language Runtime** | PHP 8.0, 8.1, 8.2, 8.3 |
| **Dependencies** | jQuery (Admin UI tab switching), Native WordPress Settings API |
| **License** | GPLv2 or later |

---

## 📂 Codebase Layout

```
product-meta-seo-plugin-for-wp-woocommerce/
├── assets/
│   ├── css/
│   │   ├── admin-style.css           # Product data tabs styling
│   │   └── front-style.css           # Front-end tab accordions & responsive grid
│   └── js/
│       └── admin-script.js           # Dynamic repeater rows & preset selectors
├── includes/
│   ├── custom-meta-fields.php        # Tab registration, rendering & meta sanitization
│   ├── helper.php                    # Data formatting & front-end template tags
│   └── settings.php                  # Global admin dashboard & preset manager
├── eazyproo-product-meta.php         # Plugin bootstrap & asset enqueuing
└── README.md
```

---

## ⚙️ Installation & Usage

### 1. Plugin Installation
1. Package the repository as `product-meta-seo-plugin.zip`.
2. In your WordPress dashboard, navigate to **Plugins $\rightarrow$ Add New $\rightarrow$ Upload Plugin**.
3. Upload and click **Activate Plugin**.

### 2. Configure Global Presets
1. Navigate to **WP Admin $\rightarrow$ Eazyproo Settings**.
2. Configure your standard platforms, operating systems, and specification templates.

### 3. Apply to Products
1. Open any WooCommerce product under **Products $\rightarrow$ Edit Product**.
2. Scroll to the **Product Data** metabox.
3. Access the newly registered specification tabs (**Overview**, **System Requirements**, **Included Apps**, **FAQs**).
4. Configure data points and click **Update**.

The specifications will automatically render on the single product page tabs!

---

## 📄 License
This plugin is licensed under the **GNU General Public License v2.0 or later (GPL-2.0+)**.
