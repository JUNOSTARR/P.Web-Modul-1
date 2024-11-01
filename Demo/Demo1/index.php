<?php

// Namespace
namespace App\Concert;

// Trait
trait Discountable {
    private $discount = 0;

    public function setDiscount($discount) {
        $this->discount = $discount;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function applyDiscount($price) {
        return $price - ($price * $this->discount / 100);
    }
}

// Abstract Class
abstract class Ticket {
    protected $price;
    protected $seat;
    protected $tax = 0.1; // Pajak 10%

    public function __construct($price, $seat) {
        $this->price = $price;
        $this->seat = $seat;
    }

    abstract public function calculateTotalPrice();

    // Tambahkan pajak ke total harga
    public function addTax($price) {
        return $price + ($price * $this->tax);
    }

    public function __toString() {
        return "Seat: {$this->seat}, Base Price: {$this->price}";
    }
    
    // Magic Method __call untuk menangani metode yang tidak ada
    public function __call($name, $arguments) {
        echo "Method '$name' tidak ditemukan.<br>";
    }
}

// Class VIPTicket
class VIPTicket extends Ticket {
    use Discountable;

    private $earlyAccess = true;
    private $freeMerchandise = true;

    public function calculateTotalPrice() {
        $discountedPrice = $this->applyDiscount($this->price);
        return $this->addTax($discountedPrice);
    }

    public function getSeatType() {
        return "VIP";
    }

    public function getBenefits() {
        $benefits = [
            "Stage Performance Access" => $this->earlyAccess ? "Yes" : "No",
            "Free Merchandise" => $this->freeMerchandise ? "Yes" : "No"
        ];
        return $benefits;
    }

    public function displayBenefits() {
        $benefits = $this->getBenefits();
        foreach ($benefits as $benefit => $value) {
            echo "{$benefit}: {$value}<br>";
        }
    }
}

// Class RegularTicket
class RegularTicket extends Ticket {
    public function calculateTotalPrice() {
        return $this->addTax($this->price);
    }

    public function getSeatType() {
        return "Regular";
    }

    public function getBenefits() {
        $benefits = [
            "Stage Performance Access" => false,
            "Free Merchandise" => false
        ];
        return $benefits;
    }

    public function displayBenefits() {
        $benefits = $this->getBenefits();
        foreach ($benefits as $benefit => $value) {
            echo "{$benefit}: " . ($value ? "Yes" : "No") . "<br>";
        }
    }
}


// Penggunaan Program
$vipTicket = new VIPTicket(200, 'A1');
$vipTicket->setDiscount(15); // Diskon 15% untuk VIP
echo "Ticket Type: " . $vipTicket->getSeatType() . "<br>";
echo "Total Price after Discount and Tax: $" . $vipTicket->calculateTotalPrice() . "<br>";
$vipTicket->displayBenefits();
echo $vipTicket . "<br><br>";

$regularTicket = new RegularTicket(100, 'B2');
echo "Ticket Type: " . $regularTicket->getSeatType() . "<br>";
echo "Total Price with Tax: $" . $regularTicket->calculateTotalPrice() . "<br>";
$regularTicket->displayBenefits();
echo $regularTicket . "<br><br>";

// Magic method __call demonstration
$vipTicket->nonExistentMethod();

?>
