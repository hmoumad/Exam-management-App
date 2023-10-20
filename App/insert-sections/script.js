
		function populate(s1,s2){
			var s1 = document.getElementById('s1');
			var s2 = document.getElementById('s2');
			s2.innerHTML =" ";
			if(s1.value == "DRF"  ){
				arrayOption= ["|","PFF11%|S1","PFF12%|S2","PFF23%|S3","PFF24%|S4","PFF35%|S5","PFF36%|S6"];
			}else if(s1.value == "SMA")
			{
				arrayOption =  ["|","PFA23%|S3","PFA24%|S4","PFA35%|S5","PFA36%|S6"];
			}
			else if(s1.value== "SMI" ){
				arrayOption =  ["|","PFI23%|S3","PFI24%|S4","PFI35%|S5","PFAI6%|S6"];

			}
			else if(s1.value=="SMIA"){
				arrayOption = ["|","PFA11%|S1","PFA12%|S2"];
			}else if(s1.value =="SMC"){
				arrayOption =  ["|","PFC23%|S3","PFC24%|S4","PFC35%|S5","PFAC6%|S6"];

			}else if(s1.value == "SMP"){
				arrayOption =  ["|","PFP23%|S3","PFP24%|S4","PFP35%|S5","PFP36%|S6"];
			}
			else if(s1.value =="SMPC"){
				arrayOption = ["|","PFC11%|S1","PFC12%|S2"];
			}
			else if(s1.value =="SVI"){
				arrayOption= ["|","PFU11%|S1","PFU12%|S2","PFV23%|S3","PFV24%|S4","PFV35%|S5","PFV36%|S6"];
			}

			for( var option in arrayOption){
				var pair = arrayOption[option].split('|');
				var newOption = document.createElement('option');
				newOption.value = pair[0];
				newOption.innerHTML = pair[1];
				s2.options.add(newOption);
			}


		}

		
	