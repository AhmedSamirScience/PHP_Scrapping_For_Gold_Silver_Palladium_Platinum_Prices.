<?php
  require "Initializing_Connection.php";
  #region Variables
  $Count_of_returned_values = 0;
  $protection_from_dropping_database = 0;
  $html_websites = array ("https://www.bullion-rates.com/palladium/EGP-history.htm", "https://www.bullion-rates.com/palladium/AED-history.htm",
								"https://www.bullion-rates.com/palladium/BHD-history.htm", "https://www.bullion-rates.com/palladium/DJF-history.htm" , "https://www.bullion-rates.com/palladium/DZD-history.htm" ,
								"https://www.bullion-rates.com/palladium/IQD-history.htm" , "https://www.bullion-rates.com/palladium/JOD-history.htm" , "https://www.bullion-rates.com/palladium/KWD-history.htm",
								"https://www.bullion-rates.com/palladium/LBP-history.htm", "https://www.bullion-rates.com/palladium/LYD-history.htm", "https://www.bullion-rates.com/palladium/MAD-history.htm",
								 	  "https://www.bullion-rates.com/palladium/OMR-history.htm"	,"https://www.bullion-rates.com/palladium/QAR-history.htm"
								,"https://www.bullion-rates.com/palladium/SAR-history.htm" ,"https://www.bullion-rates.com/palladium/SDG-history.htm" , "https://www.bullion-rates.com/palladium/SOS-history.htm",
								  "https://www.bullion-rates.com/palladium/TND-history.htm" , "https://www.bullion-rates.com/palladium/CNY-history.htm" ,"https://www.bullion-rates.com/palladium/USD-history.htm" , "https://www.bullion-rates.com/palladium/GBP-history.htm"
								, "https://www.bullion-rates.com/palladium/TRY-history.htm",	"https://www.bullion-rates.com/palladium/CAD-history.htm" , "https://www.bullion-rates.com/palladium/INR-history.htm", "https://www.bullion-rates.com/palladium/JPY-history.htm",
								"https://www.bullion-rates.com/palladium/RUB-history.htm" , "https://www.bullion-rates.com/palladium/AUD-history.htm","https://www.bullion-rates.com/palladium/CHF-history.htm", "https://www.bullion-rates.com/palladium/MXN-history.htm" , "https://www.bullion-rates.com/palladium/EUR-history.htm", "https://www.bullion-rates.com/palladium/BRL-history.htm", "https://www.bullion-rates.com/palladium/CLP-history.htm" , "https://www.bullion-rates.com/palladium/CZK-history.htm" , "https://www.bullion-rates.com/palladium/FJD-history.htm", "https://www.bullion-rates.com/palladium/HNL-history.htm", "https://www.bullion-rates.com/palladium/HKD-history.htm", "https://www.bullion-rates.com/palladium/HUF-history.htm", "https://www.bullion-rates.com/palladium/ISK-history.htm", "https://www.bullion-rates.com/palladium/IDR-history.htm", "https://www.bullion-rates.com/palladium/KRW-history.htm", "https://www.bullion-rates.com/palladium/MYR-history.htm", "https://www.bullion-rates.com/palladium/NZD-history.htm", "https://www.bullion-rates.com/palladium/PHP-history.htm", "https://www.bullion-rates.com/palladium/PLN-history.htm", "https://www.bullion-rates.com/palladium/SGD-history.htm") ;


  $Capital_City = array ("Egypt", "Dubai" , "Bahrain" , "Djibouti" , "Algeria" ,"Iraq", "Jordan", "Kuwait", "Lebanon", "Libya", "Morocco",  "Oman", "Qatar", "Saudi Arabic States", "Sudan", "Somalia", "Tunisia" , "China" , "United States", "United Kingdom" , "Turkey", "Canada", "India", "Japan" , "Russia", "Australia","Switzerland", "Mexico", "Euro Member Countries", "Brazil", "Chile", "Czechia" ,"Fiji", "Honduras" , "Hong Kong", "Hungary", "Iceland","Indonesia", "Korea (South)", "Malaysia", "New Zealand", "Philippines", "Poland", "Singapore");

  $Capital_City_In_Arabic = array ("مصر", "الامارات العربية المتحدة" , "البحرين" , "جيبوتي" , "الجزائر" ,"العراق", "الأردن", "الكويت", "لبنان", "ليبيا", "المغرب" , "عمان", "قطر", "المملكه العربيه السعوديه", "السودان", "الصومال", "تونس"  , "الصين" , "الولايات المتحدة", "المملكة المتحدة" , "تركيا", "كندا", "الهند", "اليابان" , "روسيا", "الدولار الأسترالي", "سويسرا", "المكسيك", "الدول الأعضاء في منطقة اليورو", "البرازيل", "تشيلي", "جمهورية التشيك", "فيجي", "هندوراس", "هونج كونج", "المجر", "أيسلندا", "إندونيسيا", "كوريا الجنوبيه", "ماليزيا","نيوزيلندا", "الفلبين", "بولندا", "سنغافورة");

  $Currency_Of_Capital_City = array ("Egyptian Pound", "United Arab Emirates dirham", "Bahraini Dinar" , "Djiboutian franc" , "Algerian Dinar" , "Iraqi Dinar", "Jordanian Dinar", "Kuwaiti Dinar", "Lebanese Pound", "Libyan Dinar", "Moroccan Dirham" , "Omani Rial" , "Qatari riyal" , "Saudi Arabian Riyal", "Sudanese Pound", "Somali Shilling",
                       "Tunisian Dinar", "Chinese Yuan Renminbi" , "US Dollar" , "British Pound" , "Turkish Lira" , "Canadian Dollar", "Indian Rupee", "Japanese Yen", "Russian Ruble", "Australian Dollar", "Swiss Franc", "Mexican Peso", "Euro", "Brazilian Real", "Chilean Peso" , "Czech Koruna"  , "Fijian Dollar", "Honduran Lempira", "Hong Kong Dollar", "Hungarian Forint", "Icelandic Krona", "Indonesian Rupiah", "South Korean Won", "Malaysian Ringgit", "New Zealand Dollar", "Philippine Piso", "Polish Zloty", "Singapore Dollar");

  $Currency_Of_Capital_City_In_Arabic = array ("الجنيه المصري", "الدرهم الإماراتي", "الدينار البحريني" , "الفرنك الجيبوتي" , "الدينار الجزائري" , "الدينار العراقي", "الدينار الأردني", "الدينار الكويتي", "الريال اللبناني", "الدينار الليبي", "الدرهم المغربي", "الريال العماني" , "الريال القطري" ,  "الريال السعودي", "الجنيه السوداني", "الشلن الصومالي",
																"الدينار التونسي", "يوان صيني" , "الدولار الأمريكي" , "الجنيه البريطاني" , "الليرة التركية" , "الدولار الكندي", "الروبية الهندية", "الين الياباني", "الروبل الروسي", "الدولار الأسترالي", "الفرنك السويسري" , "البيزو المكسيكي", "اليورو", "الريال البرازيلي", "البيزو الشيلي" , "الكورون التشيكي"  , "الدولار الفيجي" , "اللامبيرا الهندوراسي", "دولار هونج كونج", "الفورنت المجري" , "الكرونا الأيسلندية", "الروبية الأندونيسية", "الون الكوري الجنوبي", "الرينجت الماليزي","الدولار النيوزيلاندي", "البيزو الفلبيني", "الزلوتي البولندي", "الدولار السنغافوري");

	  #endregion

  #region Code
  for ( $i = 0 ; $i < count($html_websites) ; $i++)
  {
      $ID_of_the_capital_city = $i + 1  ;
      echo "<b>#$ID_of_the_capital_city $Capital_City[$i]:</b> <br> ";
      $Data = getting_data_by_class_name($html_websites[$i], "rate");
      if(count ($Data) > $Count_of_returned_values&& $protection_from_dropping_database < 4 )
      {
        $protection_from_dropping_database=0;
        Deletion_data ($Connection , $Capital_City[$i]);
        Insertion_data($Data , $Connection , $Capital_City[$i] , $Currency_Of_Capital_City[$i] , $Capital_City_In_Arabic[$i] , $Currency_Of_Capital_City_In_Arabic[$i]);
        $Data = "";
      }
      else
      {
        $protection_from_dropping_database++;
        $i--;
      }
      if ($protection_from_dropping_database == 4)
      {
        echo '<h2 style ="color:red;">-There is a problem.</h2>';
        break;
      }
   }
  #endregion

  #region Functions
    function Insertion_data ( $string , $con , $Capital_City , $Currency_Of_Capital_City , $Capital_City_In_Arabic , $Currency_Of_Capital_City_In_Arabic  )
    {

       for ($i = 0 ;$i <  count ($string) ; $i+=3)
       {
         $Date = $i;
         $oz= $i + 1;
         $gram= $i+2;
         $sql_query = "				INSERT INTO `3Months`(`Date`, `Ounce_Price`, `Gram_Price`, `Capital_City_In_English`, `Capital_City_In_Arabic`, `Currency_In_English`, `Currency_In_Arabic`)
                                  VALUES			 (       '$string[$Date]', '$string[$oz]', '$string[$gram]', '$Capital_City'  ,  '$Capital_City_In_Arabic', '$Currency_Of_Capital_City', '$Currency_Of_Capital_City_In_Arabic' )
                                  ";
          if( mysqli_query($con,$sql_query))
          {

          }
          else
          {
            echo '<h4 style ="color:red;" >Data Insertion error.☒</h4>'.mysqli_error($con), "<br>" ;
          }
       }

       $Number_of_data = count ( $string  )   ;
       if ($Number_of_data == $i )
       {
         $Number_of_data = $Number_of_data /3 ;
         $i = $i /3 ;
         echo "-You have inserted data and the number of acceptance data is <b>$Number_of_data/$i</b>. ☑","<br>","<br>";
       }
       else
       {
           echo '<h3 style ="color:red;" >Data Insertion error for $Capital_City.☒</h3>', "<br>" ;
       }


    }

    function Deletion_data ($con , $Capital_City)
    {
    		$sql_query_remove = "DELETE FROM `3Months` WHERE `Capital_City_In_English` like '$Capital_City'";
    		if( mysqli_query($con,$sql_query_remove))
    		{
    		   echo '<p style = "color:#00FF00; margin:0; padding:0;" >-Data has been removed.</p>'   ;
    		}
    		else
    		{
    		   echo '<h3 style = "color:red;">Data has not been removed. </h3>'.mysqli_error($con, "<br>" );
    		}
    }

    function getting_data_by_class_name( $website, $classname)
    {
      $htmlContent = file_get_contents($website);
      $DOM = new DOMDocument();
      @$DOM->loadHTML($htmlContent);
      $finder = new DomXPath($DOM);
      $data_in_class = $finder->query("//*[contains(@class, '$classname')]");

      for ( $i= 0 ; $data_in_class[$i] != null  ; $i++)
      {
        $wanted_data[$i] =   $data_in_class[$i]->textContent;
      }
      return $wanted_data ;
    }
  #endregion
?>
