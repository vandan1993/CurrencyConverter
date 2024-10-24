<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency', function (Blueprint $table) {
            $table->id();
            $table->string('currency_name');
            $table->string('currency')->unique();
            $table->timestamps();
        });

        DB::table('currency')->insert([
            ["currency_name" =>"United Arab Emirates Dirham" , "currency"=>"AED"],
            ["currency_name" =>"Afghan Afghani" , "currency"=>"AFN"],
            ["currency_name" =>"Albanian Lek" , "currency"=>"ALL"],
            ["currency_name" =>"Armenian Dram" , "currency"=>"AMD"],
            ["currency_name" =>"Netherlands Antillean Guilder" , "currency"=>"ANG"],
            ["currency_name" =>"Angolan Kwanza" , "currency"=>"AOA"],
            ["currency_name" =>"Argentine Peso" , "currency"=>"ARS"],
            ["currency_name" =>"Australian Dollar" , "currency"=>"AUD"],
            ["currency_name" =>"Aruban Florin" , "currency"=>"AWG"],
            ["currency_name" =>"Azerbaijani Manat" , "currency"=>"AZN"],
            ["currency_name" =>"Bosnia-Herzegovina Convertible Mark" , "currency"=>"BAM"],
            ["currency_name" =>"Barbadian Dollar" , "currency"=>"BBD"],
            ["currency_name" =>"Bangladeshi Taka" , "currency"=>"BDT"],
            ["currency_name" =>"Bulgarian Lev" , "currency"=>"BGN"],
            ["currency_name" =>"Bahraini Dinar" , "currency"=>"BHD"],
            ["currency_name" =>"Burundian Franc" , "currency"=>"BIF"],
            ["currency_name" =>"Bermudan Dollar" , "currency"=>"BMD"],
            ["currency_name" =>"Brunei Dollar" , "currency"=>"BND"],
            ["currency_name" =>"Bolivian Boliviano" , "currency"=>"BOB"],
            ["currency_name" =>"Brazilian Real" , "currency"=>"BRL"],
            ["currency_name" =>"Bahamian Dollar" , "currency"=>"BSD"],
            ["currency_name" =>"Bitcoin" , "currency"=>"BTC"],
            ["currency_name" =>"Bhutanese Ngultrum" , "currency"=>"BTN"],
            ["currency_name" =>"Botswanan Pula" , "currency"=>"BWP"],
            ["currency_name" =>"Belarusian Ruble" , "currency"=>"BYN"],
            ["currency_name" =>"Belarusian Ruble" , "currency"=>"BYR"],
            ["currency_name" =>"Belize Dollar" , "currency"=>"BZD"],
            ["currency_name" =>"Canadian Dollar" , "currency"=>"CAD"],
            ["currency_name" =>"Congolese Franc" , "currency"=>"CDF"],
            ["currency_name" =>"Swiss Franc" , "currency"=>"CHF"],
            ["currency_name" =>"Chilean Unit of Account (UF)" , "currency"=>"CLF"],
            ["currency_name" =>"Chilean Peso" , "currency"=>"CLP"],
            ["currency_name" =>"Chinese Yuan" , "currency"=>"CNY"],
            ["currency_name" =>"Colombian Peso" , "currency"=>"COP"],
            ["currency_name" =>"Costa Rican Colón" , "currency"=>"CRC"],
            ["currency_name" =>"Cuba Convertible Peso" , "currency"=>"CUC"],
            ["currency_name" =>"Cuban Peso" , "currency"=>"CUP"],
            ["currency_name" =>"Cape Verdean Escudo" , "currency"=>"CVE"],
            ["currency_name" =>"Czech Republic Koruna" , "currency"=>"CZK"],
            ["currency_name" =>"Djiboutian Franc" , "currency"=>"DJF"],
            ["currency_name" =>"Danish Krone" , "currency"=>"DKK"],
            ["currency_name" =>"Dominican Peso" , "currency"=>"DOP"],
            ["currency_name" =>"Algerian Dinar" , "currency"=>"DZD"],
            ["currency_name" =>"Estonian Kroon" , "currency"=>"EEK"],
            ["currency_name" =>"Egyptian Pound" , "currency"=>"EGP"],
            ["currency_name" =>"Eritrean Nakfa" , "currency"=>"ERN"],
            ["currency_name" =>"Ethiopian Birr" , "currency"=>"ETB"],
            ["currency_name" =>"Euro" , "currency"=>"EUR"],
            ["currency_name" =>"Fijian Dollar" , "currency"=>"FJD"],
            ["currency_name" =>"Falkland Islands Pound" , "currency"=>"FKP"],
            ["currency_name" =>"British Pound Sterling" , "currency"=>"GBP"],
            ["currency_name" =>"Georgian Lari" , "currency"=>"GEL"],
            ["currency_name" =>"Guernsey Pound" , "currency"=>"GGP"],
            ["currency_name" =>"Ghanaian Cedi" , "currency"=>"GHS"],
            ["currency_name" =>"Gibraltar Pound" , "currency"=>"GIP"],
            ["currency_name" =>"Gambian Dalasi" , "currency"=>"GMD"],
            ["currency_name" =>"Guinean Franc" , "currency"=>"GNF"],
            ["currency_name" =>"Guatemalan Quetzal" , "currency"=>"GTQ"],
            ["currency_name" =>"Guyanaese Dollar" , "currency"=>"GYD"],
            ["currency_name" =>"Hong Kong Dollar" , "currency"=>"HKD"],
            ["currency_name" =>"Honduran Lempira" , "currency"=>"HNL"],
            ["currency_name" =>"Croatian Kuna" , "currency"=>"HRK"],
            ["currency_name" =>"Haitian Gourde" , "currency"=>"HTG"],
            ["currency_name" =>"Hungarian Forint" , "currency"=>"HUF"],
            ["currency_name" =>"Indonesian Rupiah" , "currency"=>"IDR"],
            ["currency_name" =>"Israeli New Sheqel" , "currency"=>"ILS"],
            ["currency_name" =>"Manx pound" , "currency"=>"IMP"],
            ["currency_name" =>"Indian Rupee" , "currency"=>"INR"],
            ["currency_name" =>"Iraqi Dinar" , "currency"=>"IQD"],
            ["currency_name" =>"Iranian Rial" , "currency"=>"IRR"],
            ["currency_name" =>"Icelandic Króna" , "currency"=>"ISK"],
            ["currency_name" =>"Jersey Pound" , "currency"=>"JEP"],
            ["currency_name" =>"Jamaican Dollar" , "currency"=>"JMD"],
            ["currency_name" =>"Jordanian Dinar" , "currency"=>"JOD"],
            ["currency_name" =>"Japanese Yen" , "currency"=>"JPY"],
            ["currency_name" =>"Kenyan Shilling" , "currency"=>"KES"],
            ["currency_name" =>"Kyrgystani Som" , "currency"=>"KGS"],
            ["currency_name" =>"Cambodian Riel" , "currency"=>"KHR"],
            ["currency_name" =>"Comorian Franc" , "currency"=>"KMF"],
            ["currency_name" =>"North Korean Won" , "currency"=>"KPW"],
            ["currency_name" =>"South Korean Won" , "currency"=>"KRW"],
            ["currency_name" =>"Kuwaiti Dinar" , "currency"=>"KWD"],
            ["currency_name" =>"Cayman Islands Dollar" , "currency"=>"KYD"],
            ["currency_name" =>"Kazakhstani Tenge" , "currency"=>"KZT"],
            ["currency_name" =>"Laotian Kip" , "currency"=>"LAK"],
            ["currency_name" =>"Lebanese Pound" , "currency"=>"LBP"],
            ["currency_name" =>"Sri Lankan Rupee" , "currency"=>"LKR"],
            ["currency_name" =>"Liberian Dollar" , "currency"=>"LRD"],
            ["currency_name" =>"Lesotho Loti" , "currency"=>"LSL"],
            ["currency_name" =>"Lithuanian Litas" , "currency"=>"LTL"],
            ["currency_name" =>"Latvian Lats" , "currency"=>"LVL"],
            ["currency_name" =>"Libyan Dinar" , "currency"=>"LYD"],
            ["currency_name" =>"Moroccan Dirham" , "currency"=>"MAD"],
            ["currency_name" =>"Moldovan Leu" , "currency"=>"MDL"],
            ["currency_name" =>"Malagasy Ariary" , "currency"=>"MGA"],
            ["currency_name" =>"Macedonian Denar" , "currency"=>"MKD"],
            ["currency_name" =>"Myanma Kyat" , "currency"=>"MMK"],
            ["currency_name" =>"Mongolian Tugrik" , "currency"=>"MNT"],
            ["currency_name" =>"Macanese Pataca" , "currency"=>"MOP"],
            ["currency_name" =>"Mauritanian Ouguiya" , "currency"=>"MRO"],
            ["currency_name" =>"Mauritian Rupee" , "currency"=>"MUR"],
            ["currency_name" =>"Maldivian Rufiyaa" , "currency"=>"MVR"],
            ["currency_name" =>"Malawian Kwacha" , "currency"=>"MWK"],
            ["currency_name" =>"Mexican Peso" , "currency"=>"MXN"],
            ["currency_name" =>"Malaysian Ringgit" , "currency"=>"MYR"],
            ["currency_name" =>"Mozambican Metical" , "currency"=>"MZN"],
            ["currency_name" =>"Namibian Dollar" , "currency"=>"NAD"],
            ["currency_name" =>"Nigerian Naira" , "currency"=>"NGN"],
            ["currency_name" =>"Nicaraguan Córdoba" , "currency"=>"NIO"],
            ["currency_name" =>"Norwegian Krone" , "currency"=>"NOK"],
            ["currency_name" =>"Nepalese Rupee" , "currency"=>"NPR"],
            ["currency_name" =>"New Zealand Dollar" , "currency"=>"NZD"],
            ["currency_name" =>"Omani Rial" , "currency"=>"OMR"],
            ["currency_name" =>"Panamanian Balboa" , "currency"=>"PAB"],
            ["currency_name" =>"Peruvian Nuevo Sol" , "currency"=>"PEN"],
            ["currency_name" =>"Papua New Guinean Kina" , "currency"=>"PGK"],
            ["currency_name" =>"Philippine Peso" , "currency"=>"PHP"],
            ["currency_name" =>"Pakistani Rupee" , "currency"=>"PKR"],
            ["currency_name" =>"Polish Zloty" , "currency"=>"PLN"],
            ["currency_name" =>"Paraguayan Guarani" , "currency"=>"PYG"],
            ["currency_name" =>"Qatari Rial" , "currency"=>"QAR"],
            ["currency_name" =>"Romanian Leu" , "currency"=>"RON"],
            ["currency_name" =>"Serbian Dinar" , "currency"=>"RSD"],
            ["currency_name" =>"Russian Ruble" , "currency"=>"RUB"],
            ["currency_name" =>"Rwandan Franc" , "currency"=>"RWF"],
            ["currency_name" =>"Saudi Riyal" , "currency"=>"SAR"],
            ["currency_name" =>"Solomon Islands Dollar" , "currency"=>"SBD"],
            ["currency_name" =>"Seychellois Rupee" , "currency"=>"SCR"],
            ["currency_name" =>"Sudanese Pound" , "currency"=>"SDG"],
            ["currency_name" =>"Swedish Krona" , "currency"=>"SEK"],
            ["currency_name" =>"Singapore Dollar" , "currency"=>"SGD"],
            ["currency_name" =>"Saint Helena Pound" , "currency"=>"SHP"],
            ["currency_name" =>"Sierra Leonean Leone" , "currency"=>"SLL"],
            ["currency_name" =>"Somali Shilling" , "currency"=>"SOS"],
            ["currency_name" =>"Surinamese Dollar" , "currency"=>"SRD"],
            ["currency_name" =>"São Tomé and Príncipe Dobra" , "currency"=>"STD"],
            ["currency_name" =>"Salvadoran Colón" , "currency"=>"SVC"],
            ["currency_name" =>"Syrian Pound" , "currency"=>"SYP"],
            ["currency_name" =>"Swazi Lilangeni" , "currency"=>"SZL"],
            ["currency_name" =>"Thai Baht" , "currency"=>"THB"],
            ["currency_name" =>"Tajikistani Somoni" , "currency"=>"TJS"],
            ["currency_name" =>"Turkmenistani Manat" , "currency"=>"TMT"],
            ["currency_name" =>"Tunisian Dinar" , "currency"=>"TND"],
            ["currency_name" =>"Tongan Paanga" , "currency"=>"TOP"],
            ["currency_name" =>"Turkish Lira" , "currency"=>"TRY"],
            ["currency_name" =>"Trinidad and Tobago Dollar" , "currency"=>"TTD"],
            ["currency_name" =>"New Taiwan Dollar" , "currency"=>"TWD"],
            ["currency_name" =>"Tanzanian Shilling" , "currency"=>"TZS"],
            ["currency_name" =>"Ukrainian Hryvnia" , "currency"=>"UAH"],
            ["currency_name" =>"Ugandan Shilling" , "currency"=>"UGX"],
            ["currency_name" =>"United States Dollar" , "currency"=>"USD"],
            ["currency_name" =>"Uruguayan Peso" , "currency"=>"UYU"],
            ["currency_name" =>"Uzbekistan Som" , "currency"=>"UZS"],
            ["currency_name" =>"Venezuelan Bolívar" , "currency"=>"VEF"],
            ["currency_name" =>"Vietnamese Dong" , "currency"=>"VND"],
            ["currency_name" =>"Vanuatu Vatu" , "currency"=>"VUV"],
            ["currency_name" =>"Samoan Tala" , "currency"=>"WST"],
            ["currency_name" =>"CFA Franc BEAC" , "currency"=>"XAF"],
            ["currency_name" =>"Silver (troy ounce)" , "currency"=>"XAG"],
            ["currency_name" =>"Gold (troy ounce)" , "currency"=>"XAU"],
            ["currency_name" =>"East Caribbean Dollar" , "currency"=>"XCD"],
            ["currency_name" =>"Special Drawing Rights" , "currency"=>"XDR"],
            ["currency_name" =>"CFA Franc BCEAO" , "currency"=>"XOF"],
            ["currency_name" =>"CFP Franc" , "currency"=>"XPF"],
            ["currency_name" =>"Yemeni Rial" , "currency"=>"YER"],
            ["currency_name" =>"South African Rand" , "currency"=>"ZAR"],
            ["currency_name" =>"Zambian Kwacha (pre-2013)" , "currency"=>"ZMK"],
            ["currency_name" =>"Zambian Kwacha" , "currency"=>"ZMW"],
            ["currency_name" =>"Zimbabwean Dolla" , "currency"=>"ZWL"]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country');
    }
};
