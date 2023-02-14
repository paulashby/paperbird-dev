# Paperbird Publishing Website

  

  ## Table of Contents

  [Description](#description)<br />[Installation](#installation)<br />[Usage](#usage)<br />[Contributing](#contributing)<br />[Tests](#tests)<br />[License](#license)<br />[Questions](#questions)<br />

  ## Description

  Online catalogue with integrated wholesale order system for trade customers<br><br>
 ![Homepage](screenshots/homepage.jpg "Screenshot of paperbird website")*Paperbird homepage with image randomly loaded from a preset selection of options*<br><br>
  The site is built in PHP using the [Processwire](https://processwire.com/) content management system (CMS). Common page elements are defined as modular components and the front end of the site makes use of jQuery with styles written in SASS using the [BEM methodology](https://en.bem.info/methodology/).<br><br>Retailers can apply for an account via the [customer registration form](https://www.paperbirdpublishing.co.uk/register/), and once approved can log into the front end, view products with prices displayed and add and remove cart items.<br><br>![Lightbox](screenshots/lightbox.jpg "Screenshot of lightbox showing product with prices")*Logged in customers have access to product prices and cart functionality*<br><br>To make the site as snappy as possible, images are lazy loaded by the [LazyResponsiveImages module](https://github.com/paulashby/LazyResponsiveImages) which provides HTML5 image srcsets with appropriate image variations. The cart functionality is provided by the [OrderCart](https://github.com/paulashby/OrderCart) module. Orders can be placed directly from the cart, and when submitted, the customer is sent a notification email.<br><br>A search bar allows customers to quickly find products by artist name or keyword and a contact form is provided for customer queries.<br><br>The back end of the site allows store managers to handle both orders and contact form submissions. Order functionality is provided by the [ProcessOrderPages module](https://github.com/paulashby/ProcessOrderPages). Pending orders are listed on the Orders page and when forwarded to the print-per-order service are tagged as processed. Fulfilled orders are tagged as completed and removed from the system.<br><br>![Lightbox](screenshots/orders.jpg "Screenshot of order listings")*The order listing page*<br><br> Form submissions are managed on the Contact page which is generated by the [ProcessContactPages module](https://github.com/paulashby/ProcessContactPages). Here customers' messages can be tagged as Processed or Resolved and registration applications accepted or rejected.<br><br>Products are added to the system as pages (with the page tree mirroring the structure of the front end of the site). The product page accepts supplementary information such as search tags and allows existing product variations to be linked to via a dynamically populated select menu.<br><br>![Paper and Price](screenshots/paper-price.jpg "Screenshot of paper and price set up screens")*Once configured, paper specs (left) can be applied to multiple price categories (right)*<br><br>![Product page](screenshots/product-page.jpg "Screenshot of backend product page")*Adding a product - price categories can be appied to multiple products*<br><br>Form submissions are managed on the Contact page which is generated by the [ProcessContactPages module](https://github.com/paulashby/ProcessContactPages).The price category is defined on a seprate page and includes price, size and paper spec.<br><br>A paper spec can be used by mutliple price categories and defines paper stock and order quantity information. Defining price category and paper spec separately allows the latter to be updated for multiple price categories in a single operation.<br><br>The live site can be viewed [here](https://www.paperbirdpublishing.co.uk/)
  
  ## Installation
  
  Although the site itself is not intended to be used as a shared resource, you may be interested in making use of the modules If so, please follow the installation instructions in their respective repositories.<br>
- [ProcessOrderPages](https://github.com/paulashby/ProcessOrderPages)
- [LazyResponsiveImages](https://github.com/paulashby/LazyResponsiveImages)
- [OrderCart](https://github.com/paulashby/OrderCart)
- [ProcessContactPages](https://github.com/paulashby/ProcessContactPages)<br>
  
## Usage
  
  N/A
  
  ## Contributing
  
  If you would like to make a contribution any of the modules, simply fork the relevant respository and submit a Pull Request. If I like it, I may include it in the codebase.
  
  ## Tests
  
  N/A
  
  ## License
  
  None
  
  ## Questions
  
  Feel free to [email me](mailto:paul@primitive.co?subject=Paperbird%20Publishing%20Website%20query%20from%20GitHub) with any queries. If you'd like to see some of my other projects, my GitHub user name is [paulashby](https://github.com/paulashby).