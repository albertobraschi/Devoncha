How to solve orders not updating problem:

Open functions.php and find this:

//include_once($functions_path.'order_table_cleaner.php'); //Delete Old order information and insert new order table
//include_once($functions_path.'shipping_table_cleaner.php'); //Delete Old shipping information and insert new order table
//include_once($functions_path.'tax_table_cleaner.php'); //Delete Old tax information and insert new order table

And change this to :

include_once($functions_path.'order_table_cleaner.php'); //Delete Old order information and insert new order table
include_once($functions_path.'shipping_table_cleaner.php'); //Delete Old shipping information and insert new order table
include_once($functions_path.'tax_table_cleaner.php'); //Delete Old tax information and insert new order table

Now, if you are facing problem with order information, then just make the changes in first line. I mean just remove // from first line and dont do anything with other lines.
-If you are having problem with shipping information then remove // from second line
-If you are having problem with tax information then remove // from second line

What this will do ?
It will reset all your order information or tax information or shipping information to zero. Now you again start as its a new website. 