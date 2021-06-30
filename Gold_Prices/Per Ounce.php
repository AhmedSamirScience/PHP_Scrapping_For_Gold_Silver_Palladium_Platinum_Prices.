<?php
                                                                                           
																						   
	#region content 
	  ini_set('max_execution_time', 240); //300=5 minutes
	    $html_websites = array ("http://www.goldrate24.com/gold-prices/middle-east/egypt/", "http://www.goldrate24.com/gold-prices/middle-east/united_arab_emirates/", 
								"http://www.goldrate24.com/gold-prices/middle-east/bahrain/", "http://www.goldrate24.com/gold-prices/middle-east/djibouti/" , "http://www.goldrate24.com/gold-prices/middle-east/algeria/" , 
								"http://www.goldrate24.com/gold-prices/middle-east/iraq/" , "http://www.goldrate24.com/gold-prices/middle-east/jordan/" , "http://www.goldrate24.com/gold-prices/middle-east/kuwait/",
								"http://www.goldrate24.com/gold-prices/middle-east/lebanon/", "http://www.goldrate24.com/gold-prices/middle-east/libya/", "http://www.goldrate24.com/gold-prices/middle-east/morocco/",
								"http://www.goldrate24.com/gold-prices/middle-east/mauritania/"	, "http://www.goldrate24.com/gold-prices/middle-east/oman/"	,"http://www.goldrate24.com/gold-prices/middle-east/qatar/"
								,"http://www.goldrate24.com/gold-prices/middle-east/saudi_arabia/" ,"http://www.goldrate24.com/gold-prices/middle-east/sudan/" , "http://www.goldrate24.com/gold-prices/middle-east/somalia/",
								"http://www.goldrate24.com/gold-prices/middle-east/syria/",  "http://www.goldrate24.com/gold-prices/middle-east/tunisia/" , "http://www.goldrate24.com/gold-prices/middle-east/yemen/"	, "http://www.goldrate24.com/gold-prices/asia/china/" ,"http://www.goldrate24.com/gold-prices/north-america/united_states/" , "http://www.goldrate24.com/gold-prices/europe/united_kingdom/" , "http://www.goldrate24.com/gold-prices/europe/turkey/"
								,	"http://www.goldrate24.com/gold-prices/north-america/canada/" , "http://www.goldrate24.com/gold-prices/asia/india/", "http://www.goldrate24.com/gold-prices/asia/japan/", "http://www.goldrate24.com/gold-prices/europe/russia/") ;
			 
		 
		$Gold_Units = array ("1 Ounce 24K" ,"1 Ounce 22K" ,"1 Ounce 21K" ,"1 Ounce 18K" ,"1 Ounce 14K" ,"1 Ounce 12K" ,"1 Ounce 10K"   );
							 
							 
      	$Capital_City = array ("Egypt", "Dubai" , "Bahrain" , "Djibouti" , "Algeria" ,"Iraq", "Jordan", "Kuwait", "Lebanon", "Libya", "Morocco", "Mauritania", "Oman", "Qatar", "Saudi Arabic States", "Sudan", "Somalia", "Syria", "Tunisia" , "Yemen" , "China" , "United States", "United Kingdom" , "Turkey", "Canada", "India", "Japan" , "Russia"); 
		$Capital_City_In_Arabic = array ("مصر", "الامارات العربية المتحدة" , "البحرين" , "جيبوتي" , "الجزائر" ,"العراق", "الأردن", "الكويت", "لبنان", "ليبيا", "المغرب", "موريتانيا", "عمان", "قطر", "المملكه العربيه السعوديه", "السودان", "الصومال", "سوريا", "تونس" , "اليمن" , "الصين" , "الولايات المتحدة", "المملكة المتحدة" , "تركيا", "كندا", "الهند", "اليابان" , "روسيا"); 
	
		$Currency_Of_Capital_City = array ("Egyptian Pound", "United Arab Emirates dirham", "Bahraini Dinar" , "Djiboutian franc" , "Algerian Dinar" , "Iraqi Dinar", "Jordanian Dinar", "Kuwaiti Dinar", "Lebanese Pound", "Libyan Dinar", "Moroccan Dirham", "Mauritanian ouguiya" , "Omani Rial" , "Qatari riyal" , "Saudi Arabian Riyal", "Sudanese Pound", "Somali Shilling", "Syrian Pound",
										   "Tunisian Dinar", "Yemeni rial", "Chinese Yuan Renminbi" , "US Dollar" , "British Pound" , "Turkish Lira" , "Canadian Dollar", "Indian Rupee", "Japanese Yen", "Russian Ruble"); 
	$Currency_Of_Capital_City_In_Arabic = array ("الجنيه المصري", "الدرهم الإماراتي", "الدينار البحريني" , "الفرنك الجيبوتي" , "الدينار الجزائري" , "الدينار العراقي", "الدينار الأردني", "الدينار الكويتي", "الريال اللبناني", "الدينار الليبي", "الدرهم المغربي", "الأوقية الموريتانية" , "الريال العماني" , "الريال القطري" ,  "الريال السعودي", "الجنيه السوداني", "الشلن الصومالي", "الجنيه السوري",
										   "الدينار التونسي", "الريال اليمني", "يوان صيني" , "الدولار الأمريكي" , "الجنيه البريطاني" , "الليرة التركية" , "الدولار الكندي", "الروبية الهندية", "الين الياباني", "الروبل الروسي"); 
	
	#endregion
																							  
																							  
																							  
 
	#region Connection 
    require "init.php"; 
	#endregion
  
  
    #region fuckin code 
  $number_of_capital_cities = count ($Capital_City);
  for ( $big_i = 0 ; $big_i <$number_of_capital_cities ; $big_i ++ )
  {
	  $number_of_id_of_the_city = $big_i + 1 ; 
	   echo " <b>#$number_of_id_of_the_city </b>", "<b> $Capital_City[$big_i]:</b> <br>";
 
  
  
    #region delete the old data 
  
    $sql_query_remove = "DELETE FROM `gold_price_per_ounce` WHERE `Capital_City` like '$Capital_City[$big_i]' ";   
					
					
				if( mysqli_query($con,$sql_query_remove))
				{ 
					echo "-Data has been removed. ", "<br>"  ;
				}
				else
				{
					echo"<h3>Data has not been removed. </h3>".mysqli_error($con, "<br>" ); 	
				}
  
  
  #endregion 
 
		
		

    #region get the content of the source code 
	
	$htmlContent = file_get_contents($html_websites[$big_i] );
	$DOM = new DOMDocument(); 
	@$DOM->loadHTML($htmlContent);	 
	$Detail = $DOM->getElementsByTagName('tr');

	
	//#Get row data/detail table without header name as key
	$i = 0;
	$aDataTableDetailHTML = null ; 
	foreach($Detail as $sNodeDetail) 
	{
		      
        $new_str = str_replace("\xC2\xA0", '', $sNodeDetail->textContent);
		$aDataTableDetailHTML[$i]  = trim( $new_str);
		// print ($aDataTableDetailHTML[$i] ) ;
		// echo ".";
		// echo "<br>";
		$i = $i + 1;
	}
	#endregion 
	
	
	
	
	
	#region search on the values that you want 

	$num_of_acceptance = 0 ; 
	
	$num_of_rows_Gold_Units = count($Gold_Units );
	$num_of_rows_aDataTableDetailHTML = count ($aDataTableDetailHTML);
	
	for ($k = 0 ; $k < $num_of_rows_aDataTableDetailHTML; $k++ )
	{
		    $pieces=null;
			$pieces = explode(" ", $aDataTableDetailHTML[$k]);
			$num_of_rows = count($pieces) ; 
			
			for ($m = 0 ; $m < $num_of_rows_Gold_Units ; $m++)
			{
				

				if ( strpos($aDataTableDetailHTML[$k], $Gold_Units[$m])!== false  ) 
				{	
			
			       $pieces = array_merge(array_diff($pieces, array("")));
				   $num_of_rows = count($pieces) ; 
			       $Gold_Price_in_Specific_Currency = $num_of_rows -2 ; 
				   $Gold_Price_in_US_Dollar = $num_of_rows -1;
			 
					$sql_query = " 					 
								 
								INSERT INTO `gold_price_per_ounce`(`Ounce_Carat`, `Gold_Price_Per_Ounce_in_Specific_Currency`, `Gold_Price_Per_Ounce in_US_Dollar`, `Capital_City`, `Date_Of_Update`, `Currency_Of_Capital_City`, `Name_Of_Currency_In_Arabic`, `Capital_City_In_Arabic`) 
												VALUES              ('$Gold_Units[$m]' ,'$pieces[$Gold_Price_in_Specific_Currency]'  ,'$pieces[$Gold_Price_in_US_Dollar]'    ,
												                     '$Capital_City[$big_i]' ,now() , '$Currency_Of_Capital_City[$big_i]', '$Currency_Of_Capital_City_In_Arabic[$big_i]'  , '$Capital_City_In_Arabic[$big_i]'  )	; 
									 "    ;	
							 
					if( mysqli_query($con,$sql_query))
					{
						/*						
						  echo   $num_of_acceptance , "- ",  $pieces[$Gold_Price_in_Specific_Currency] , "  ----  " ,$pieces[$Gold_Price_in_US_Dollar] ,
							   "  ( ", 	  $Capital_City[$big_i] , " ) " ;
						  echo "<br>" ;
						*/
					  $num_of_acceptance ++ ; 
					}
					else
					{
					  echo "<h3>Data Insertion error....  </h3>".mysqli_error($con) , " ----> ", $Capital_City[$big_i] ; 	
					  echo "<br>" ;
					} 

					
			      
				 
				}
			}			
	}
	
			echo "-You have inserted data and the number of acceptance data is <b>$num_of_acceptance/7</b>." , "<br> <br>";

	 
	
	
	 #endregion
	
	 }
 	echo "-<b>Note:</b> We have 28 countries. ";
  #endregion
 
?>