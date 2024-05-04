// Define an item constructor
/** Vertical Scroller  */

// Define an item constructor
class ScrollerItems {
    constructor(imageUrl, title, description, link) {
        this.imageUrl = imageUrl;
        this.title = title;
        this.description = description;
        this.link = link;
    }

    // Generate HTML for individual item
    getHTML() {
        return `
            <div class="carousel-item">
                <img src="${this.imageUrl}" alt="${this.title}">
                <h3>${this.title}</h3>
                <p>${this.description}</p>
                <a href="${this.link}">Learn More</a>
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
        typeof localizedObject !== 'undefined' && localizedObject.description1 ? localizedObject.description1 : '' ,
        '#'
    ),


    new ScrollerItems('https://via.placeholder.com/150', 'Title 2', 'Description 2', '#'),
    new ScrollerItems('https://via.placeholder.com/150', 'Title 3', 'Description 3', '#'),
    new ScrollerItems('https://via.placeholder.com/150', 'Title 4', 'Description 4', '#'),
    new ScrollerItems('https://via.placeholder.com/150', 'Title 5', 'Description 5', '#'),
    new ScrollerItems('https://via.placeholder.com/150', 'Title 6', 'Description 6', '#'),
    new ScrollerItems('https://via.placeholder.com/150', 'Title 7', 'Description 7', '#'),
    new ScrollerItems('https://via.placeholder.com/150', 'Title 8', 'Description 8', '#'),
];

generateScroller(carouselItems, 'my-scroller', 8);

jQuery(document).ready(function($) {
    $('#my-scroller').slick({
        infinite: true,
        vertical: true,
        verticalSwiping: true,
        slidesToShow: 2,
        slidesToScroll: 2,
        arrows: true,
        prevArrow: "<button type='button' class='slick-prev'>&#x25B2;</button>",
        nextArrow: "<button type='button' class='slick-next'>&#x25BC;</button>",
    });
});
