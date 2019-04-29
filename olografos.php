<?php

class numberToString
{

    public function __construct($number)
    {
        $this->_original = trim($number);
        $this->parse();
    }

    public function parse()
    {
        //if number is passed Start
        if (isset($this->_original)) {
            $f = new NumberFormatter("el_GR", NumberFormatter::SPELLOUT);

            $amount = explode(".", $this->_original);
            $amount['integer'] = $f->format($amount[0]);
            $amount['integer_currency'] = 'ΕΥΡΩ';

            if (!isset($amount[1])) {
                $amount['decimal'] = '';
                $amount['and'] = '';
                $amount['decimal_currency'] = '';
            } else {
                $amount['decimal'] = $f->format($amount[1]);
                $amount['and'] = 'KAI';
                $amount['decimal_currency'] = 'ΛΕΠΤΑ';
            }

            $text = $amount['integer'] . ' ' . $amount['integer_currency'] . ' ' . $amount['and'] . ' ' . $amount['decimal'] . ' ' . $amount['decimal_currency'];

            echo $this->ToUpper($text);

        } //if number is passed End
    }

    public function ToUpper($string)
    {
        $search = array("Ά", "Έ", "Ή", "Ί", "Ϊ", "ΐ", "Ό", "Ύ", "Ϋ", "ΰ", "Ώ");
        $replace = array("Α", "Ε", "Η", "Ι", "Ι", "Ι", "Ο", "Υ", "Υ", "Υ", "Ω");
        $string = mb_strtoupper($string, "UTF-8");

        return str_replace($search, $replace, $string);
    }

}

?>

<!-- Print Form to input Start  -->
<form action="" method="post">
  <input type="text" name="amount" id="Amount">
  <input type="submit" value="Ολογράφως το ποσό">
</form>
<!-- Print Form to input End  -->

<?php
if (!empty($_POST)) {
    $theprice = str_replace(",",".",$_POST['amount']); //greek decimals compatible, if , is selected for decimal convert to .
    if ($theprice){$price=$theprice;} else {$price = $_POST['amount'];}
} else {
    $price = 0;
}
?>

<?php

//Displaying amount using local formats
$a = new NumberFormatter("el_GR", NumberFormatter::DECIMAL);
echo $a->format($price);

echo '<br />';

// Input the amount
$n2s = new numberToString($price);