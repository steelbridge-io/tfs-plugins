// Define an item constructor
/** Vertical Scroller  */

// Define an item constructor
class ScrollerItems {
    constructor(imageUrl, title, subtitle, description, link, id) {
        this.imageUrl = imageUrl;
        this.title = title;
        this.subtitle = subtitle;
        this.description = description;
        this.link = link;
        this.id = id;
    }

    // Generate HTML for individual item
    getHTML() {
        return `
            <div class="mfcp-carousel-item">
                <div class="mfcp-carousel-item-row">
                    <div id="mfcp-item-image-${this.id}" class="mfcp-carousel-item-img-container">
                        <img src="${this.imageUrl}" alt="${this.title}">
                    </div>
                    <div id="mfcp-item-text-${this.id}" class="mfcp-carousel-item-description-container">
                        <h3>${this.title}</h3>
                        <h4>${this.subtitle}</h4>
                        <p>${this.description}</p>
                        <a href="${this.link}">Learn More</a>
                    </div>
                </div>
            </div>
        `;
    }
}

// Generate carousel
function generateScroller(carouselItems, targetDivId, maxNumItems = 8) {
    const targetDiv = document.getElementById(targetDivId);
    let scrollerHTML = '';
    for (let i = 0; i < Math.min(maxNumItems, carouselItems.length); i++) {

        scrollerHTML += carouselItems[i].getHTML();
    }
    targetDiv.innerHTML = scrollerHTML;
}

/**
 * Array of carousel items.
 * The provided block of code is an instantiation of a new object from a class ScrollerItems. It can be referred to as an "Object Instantiation Statement".
 * Here's the breakdown:
 * new ScrollerItems() is a constructor call. This is essentially initializing (creating) a new ScrollerItems object.
 * The code inside parentheses ( ...) is the arguments that you are passing to the constructor. In this case, you are passing four arguments:
 * 1st argument: An expression using a ternary operator to determine the value. This is a conditional expression that assigns the value of localizedObject.image if it exists, otherwise it assigns 'https://via.placeholder.com/150'.
 * 2nd argument: Similar to the first, another expression using a ternary operator. This assigns the value of localizedObject.title if it exists, otherwise an empty string.
 * 3rd argument: A string 'Description 1'.
 * 4th argument: A string '#'.
 * So, as a whole, the given block of code statements is more specifically a constructor call or an object instantiation statement, where a new ScrollerItems object is being created with distinct property values.
 * @type {ScrollerItems[]}
 */
let carouselItems = [
    new ScrollerItems(
        typeof localizedObject !== 'undefined' && localizedObject.image1 ? localizedObject.image1 : 'https://via.placeholder.com/150',
        typeof localizedObject !== 'undefined' && localizedObject.title1 ? localizedObject.title1 : '',
        typeof localizedObject !== 'undefined' && localizedObject.subtitle1 ? localizedObject.subtitle1 : '',
        typeof localizedObject !== 'undefined' && localizedObject.description1 ? localizedObject.description1 : '',
        typeof localizedObject !== 'undefined' && localizedObject.link1 ? localizedObject.link1 : '',
        16789

    ),

    //new ScrollerItems('https://via.placeholder.com/150', 'Title 2', 'Sub Title 2', 'Description 2', '#', 26789),
    new ScrollerItems(
        typeof localizedObject !== 'undefined' && localizedObject.image2 ? localizedObject.image2 : 'https://via.placeholder.com/150',
        typeof localizedObject !== 'undefined' && localizedObject.title2 ? localizedObject.title2 : '',
        typeof localizedObject !== 'undefined' && localizedObject.subtitle2 ? localizedObject.subtitle2 : '',
        typeof localizedObject !== 'undefined' && localizedObject.description2 ? localizedObject.description2 : '',
        typeof localizedObject !== 'undefined' && localizedObject.link2 ? localizedObject.link2 : '',
        26789
    ),

    //new ScrollerItems('https://via.placeholder.com/150', 'Title 3', 'Sub Title 3', 'Description 3', '#', 36789),
    new ScrollerItems(
        typeof localizedObject !== 'undefined' && localizedObject.image3 ? localizedObject.image3 : 'https://via.placeholder.com/150',
        typeof localizedObject !== 'undefined' && localizedObject.title3 ? localizedObject.title3 : '',
        typeof localizedObject !== 'undefined' && localizedObject.subtitle3 ? localizedObject.subtitle3 : '',
        typeof localizedObject !== 'undefined' && localizedObject.description3 ? localizedObject.description3 : '',
        typeof localizedObject !== 'undefined' && localizedObject.link3 ? localizedObject.link3 : '',
        36789
    ),

    //new ScrollerItems('https://via.placeholder.com/150', 'Title 4', 'Sub Title 4', 'Description 4', '#', 46789),
    new ScrollerItems(
        typeof localizedObject !== 'undefined' && localizedObject.image4 ? localizedObject.image4 : 'https://via.placeholder.com/150',
        typeof localizedObject !== 'undefined' && localizedObject.title4 ? localizedObject.title4 : '',
        typeof localizedObject !== 'undefined' && localizedObject.subtitle4 ? localizedObject.subtitle4 : '',
        typeof localizedObject !== 'undefined' && localizedObject.description4 ? localizedObject.description4 : '',
        typeof localizedObject !== 'undefined' && localizedObject.link4 ? localizedObject.link4 : '',
        46789
    ),

    //new ScrollerItems('https://via.placeholder.com/150', 'Title 5', 'Sub Title 5', 'Description 5', '#', 56789),
    new ScrollerItems(
        typeof localizedObject !== 'undefined' && localizedObject.image5 ? localizedObject.image5 : 'https://via.placeholder.com/150',
        typeof localizedObject !== 'undefined' && localizedObject.title5 ? localizedObject.title5 : '',
        typeof localizedObject !== 'undefined' && localizedObject.subtitle5 ? localizedObject.subtitle5 : '',
        typeof localizedObject !== 'undefined' && localizedObject.description5 ? localizedObject.description5 : '',
        typeof localizedObject !== 'undefined' && localizedObject.link5 ? localizedObject.link5 : '',
        56789
    ),

    //new ScrollerItems('https://via.placeholder.com/150', 'Title 6', 'Sub Title 6', 'Description 6', '#', 66789),
    new ScrollerItems(
        typeof localizedObject !== 'undefined' && localizedObject.image6 ? localizedObject.image6 : 'https://via.placeholder.com/150',
        typeof localizedObject !== 'undefined' && localizedObject.title6 ? localizedObject.title6 : '',
        typeof localizedObject !== 'undefined' && localizedObject.subtitle6 ? localizedObject.subtitle6 : '',
        typeof localizedObject !== 'undefined' && localizedObject.description6 ? localizedObject.description6 : '',
        typeof localizedObject !== 'undefined' && localizedObject.link6 ? localizedObject.link6 : '',
        66789
    ),

    //new ScrollerItems('https://via.placeholder.com/150', 'Title 7', 'Sub Title 7', 'Description 7', '#', 76789),
    new ScrollerItems(
        typeof localizedObject !== 'undefined' && localizedObject.image7 ? localizedObject.image7 : 'https://via.placeholder.com/150',
        typeof localizedObject !== 'undefined' && localizedObject.title7 ? localizedObject.title7 : '',
        typeof localizedObject !== 'undefined' && localizedObject.subtitle7 ? localizedObject.subtitle7 : '',
        typeof localizedObject !== 'undefined' && localizedObject.description7 ? localizedObject.description7 : '',
        typeof localizedObject !== 'undefined' && localizedObject.link7 ? localizedObject.link7 : '',
        76789
    ),

    //new ScrollerItems('https://via.placeholder.com/150', 'Title 8', 'Sub Title 8', 'Description 8', '#', 86789),
    new ScrollerItems(
        typeof localizedObject !== 'undefined' && localizedObject.image8 ? localizedObject.image8 : 'https://via.placeholder.com/150',
        typeof localizedObject !== 'undefined' && localizedObject.title8 ? localizedObject.title8 : '',
        typeof localizedObject !== 'undefined' && localizedObject.subtitle8 ? localizedObject.subtitle8 : '',
        typeof localizedObject !== 'undefined' && localizedObject.description8 ? localizedObject.description8 : '',
        typeof localizedObject !== 'undefined' && localizedObject.link8 ? localizedObject.link8 : '',
        86789
    ),
];

generateScroller(carouselItems, 'my-scroller', 8);

jQuery(document).ready(function ($) {
    $('#my-scroller').slick({
        infinite: true,
        vertical: true,
        verticalSwiping: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: "<button type='button' class='slick-prev'><i class=\"mfpc-publication fa fa-chevron-up\" aria-hidden=\"true\"></i></button>",
        nextArrow: "<button type='button' class='slick-next'><i class=\"mfpc-publication fa fa-chevron-down\" aria-hidden=\"true\"></i></button>",
    });
});
