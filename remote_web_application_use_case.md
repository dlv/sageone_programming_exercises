# SageOne Brasil Remote Web Application Use Case

The following exercise is a real use case where you should understand the problem and build a complete solution.

### Guidance

* You can choose any language you like. Also, you are free to use any existing libraries/frameworks that you might find helpful.
* Your solution **must** be a fully web-based application including a database solution.
* You can fork this GitHub repository and answer back as a **Pull Request** for your (our) convenience.

### The Problem

You work for an online invoice software company. The software is called SageOne. :smile:

You are being requested to build a new feature aimed to easily migrate customers from two of our main competitors. The two biggest ones are named *BlueBill* and *YouDoInvoice*.

The main concern for any customer to switch between invoice software is her/his existing **Products** database. We know that the two competitors can export the entire customer's **Products** database in text files but, *BlueBill* and *YouDoInvoice* export the data in different formats.

In this new feature, the customer will be able to upload files which will fill SageOne's database with **Products**. This way, a customer can easily move from these competitors and start using **SageOne**.

The first thing the application needs is a complete set of CRUD operations for **Products**.

Once **Products** CRUDs are created, the application must:
- Have a single page where the user uploads a file;
- Accept files from both *BlueBill* and *YouDoInvoice* software;
- Parse each file and import **Products** with as many information from each file as possible.

Here are the details about each file:

#### BlueBill Files:

* Text CSV file with values separated by semicolon.
* The first line contains column headers
* Here is an example: [bluebill_product_file.csv](remote_web_application_assets/bluebill_product_file.csv)

#### YouDoInvoice Files:

* The format of YouDoInvoice File is a bit more complicated :sweat:
* It's plain text files with a self-created format;
* The first line of each file contains 2 values separated by `|` *(or pipe)*. The first value specifies the kind of resource in the file while the second one states the number of these resources:
  * A file with 15 products inside will have: `PRODUTO|15` in the first line;
* The next line can split product data in several lines.\;
* You can consider just the lines starting with `I`;
* The lines starting with `I` contain columns separated by `|` *(or pipe)*;
* There are no column headers. This information is presented on each column as follows:
  1. Fixed letter `I`
  2. Code
  3. Description
  4. Barcode
  5. NCM Code
  6. IPI
  7. Gender
  8. Unity
  9. Value
  10. Barcode *(yes, again...)*
  11. Unity *(yes, again...)*
  12. Value *(yes, again...)*
  13. Quantity
* As you can see, there are some duplicated columns, you need to see which one has a value. In case that both (duplicated) columns are filled, the last one must be chosen;
* Here is an example: [youdoinvoice_product_file.txt](remote_web_application_assets/youdoinvoice_product_file.txt).

### Acceptance Criteria

1. A user should be able to access the web application and Create, Retrieve, Update and Delete Products.
2. This web application should have a single page where the user can upload a single file.
3. A single file must be accepted each time.
4. If the application understands the uploaded file (It has a valid format for *BlueBill* or *YouDoInvoice* products file), all products in the file must be imported.
  * The product list must now display all products contained inside the imported file.
  * Every attribute of every imported product must match the uploaded file contents.
5. If the application does not understand the uploaded file, an error message should be displayed.
6. If there was any error while importing a product, the whole file can't be imported and an error message should be displayed.
