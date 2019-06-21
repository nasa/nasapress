# Custom Theme Customizations using CSS
Below you will find some example CSS snippits that you can add to your sites Additional CSS editor to provide more control over the look and design of your theme.

## Navigation Menu Width Customization
If your main navigation menu is too small on your page and links are crowding together then you can use this snippet to make the menu spread out over more of the top portion of the page. You may change the with setting with any recogonized option such as a %, em, rem, or px unit.

    .usa-nav-container {
        max-width: 75%
    }

## Current Page Indicator Color Customization
The following snippet allows you to change the color of the current page indicator shown on the main navigation menu of your site.

    .usa-nav-link:hover span,
    .usa-nav-primary a.usa-current span,
    .usa-nav-primary li.current-menu-item a span,
    .usa-nav-dark .usa-nav-primary button[aria-expanded="true"] span {
	    border-bottom: 0.4rem solid #f09e3e !important;
    }

## Footer Background Color Customization
The following snippet allows you to change the color of the footer's background color on your site. When doing this you may need to change the color of the font in your footer. This can be done by adding the font's tag to the CSS class section. A resulting definition may look like `.usa-footer-secondary_section p` and within the body you will want to replace background color with `color`.

    .usa-footer-secondary_section {
        background-color: #212121;
    }


## Footer Content Width
If you would like to change the width of the content of your footer you may do so by applying the following snippet. You may change the with setting with any recogonized option such as a %, em, rem, or px unit.

    .usa-footer-secondary_section .usa-grid {
        max-width: 75%
    }