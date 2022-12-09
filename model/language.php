<?php
$memId = $_SESSION['SESS_MEMBER_ID'];
$sql = "SELECT language FROM members WHERE member_id = $memId";
$result = $db->query($sql);
//$result = $db->query($sql);

while( $row = $result->fetch(PDO::FETCH_ASSOC)) {
    $lang = $row["language"];
}
//while ($row = mysql_fetch_array($result)) {
//    $lang = $row["language"];
//}
//if (isset($_COOKIE["lang"])) {
//	$lang = $_COOKIE["lang"]; }
//	else {$lang = 0;}
	$mainMenu=array();
	$tList=array();
	$mainMenu[]=array("Land Details","ඉඩම් විස්තර","காணி"); //0
	$mainMenu[]=array("Building Details","ගොඩනැඟිලි විස්තර","கட்டிடம்"); //1
	$mainMenu[]=array("Plant & Machinery","යන්ත්‍ර උපකරණ","தாவர எந்திரங்கள்"); //2
	$mainMenu[]=array("Office Equipment","කාර්ය්‍යාලීය උපකරණ","அலுவலக உபகரணம்"); //3
	$mainMenu[]=array("Vehicle Details","වාහන විස්තර","வாகன விவரம்"); //4
	$mainMenu[]=array("Tender Details","ටෙන්ඩර් විස්තර","டெண்டர் விவரம்"); //5
	$mainMenu[]=array("Current Assets","ජංගම වත්කම්","நடப்பு சொத்து"); //6
	
	$subMenu=array();
	$errors = array();
	$errors[] = array("Enter Data and  press - Add Details - Button","විස්තර ඇතුල් කර - Add Details - බොත්තම ක්ලික් කරන්න","தரவு உள்ளிடவும் மற்றும் செய்தியாளர் விவரம் பட்டன் சேர்"); //0
	
	$inqtype=array("Inquiry Type","විස්තර සොයන ආකාරය","விசாரணை வகை");
	$expexcel=array("Export to Excel","Excel වලට හැරවීමට","Excel ஏற்றுமதி");
	$exppdf=array("Export to PDF","PDF වලට හැරවීමට","PDF ஏற்றுமதி");
	
switch ($page) {
    case 1:
		$subMenu[]=array("Land Details List","ඉඩම් විස්තර ලයිස්තුව","காணி பட்டியல்"); //0
		$subMenu[]=array("Add Land Details","ඉඩම් විස්තර ඇතුල් කිරීම","சேர் காணி"); //1
		$subMenu[]=array("Approve Details","විස්තර අනුමත කිරීම","விவரம் ஒப்புதல்"); //2
		$subMenu[]=array("Inquiry","විස්තර සෙවීම","விசாரணை"); //3
		$subMenu[]=array("Allow Modifications","විස්තර වෙනස් කිරීම","திருத்தங்கள் அனுமதி");//4

		$slideBar[]=array("Land Details","ඉඩම් විස්තර","நிலங்களின் விவரங்கள்"); //0
		$slideBar[]=array("Approve Land Details","ඉඩම් විස්තර අනුමැතිය","காணியின் ஒப்புதல்"); //1
		$slideBar[]=array("Pending Approve Land","අනුමැතියට ඉදිරිපත් කල","ஒப்புதல் நிலுவையில்"); //2
		$slideBar[]=array("Approved Lands","අනුමත කල ඉඩම්","நிலங்கள் ஒப்புதல்"); //3
		$slideBar[]=array("Approval Rejected","අනුමත නොකල ඉඩම්","ஒப்புதல் நிராகரிக்கப்பட்டது"); //4
		$slideBar[]=array("Inquiry List","විස්තර සෙවීමේ ලයිස්තුව","விசாரணை பெற"); //5
		$slideBar[]=array("Modification Items List","වෙනස් කිරීමේ ලයිස්තුව","மாற்றம் பட்டிப்");//6
		
		$tList[]=array("Assets Center :","වත්කම් මධ්‍යස්ථානය   :","சொத்துக்கள் மையம் :"); //0
		$tList[]=array("Assets Unit :","වත්කම් ඒකකය   :","சொத்துக்கள் யூனிட் :"); //1
		$tList[]=array("Province :","පලාත   :","மாகாண :"); //2
		$tList[]=array("District :","දිස්ත්‍රික්කය   :","மாவட்ட :"); //3
		$tList[]=array("DS Division :","ප්‍රා. ලේ. කොට්ඨාශය   :","DS பிரிவு :"); //4
		$tList[]=array("GS Division :","ග්‍රා. සේ. කොට්ඨාශය   :","GS பிரிவு :"); //5
		$tList[]=array("Land Category :","ඉඩම් වර්ගය   :","நிலங்கள் வகை :"); //6
		$tList[]=array("Assets No/Classification No :","වත්කම් / වර්ගීකරණ අංක   :","சொத்துக்கள் இல்லை / தள இல்லை :"); //7
		$tList[]=array("Nature of the Ownership :","හිමිකමේ ස්භාවය   :","உரிமையாளர் இயற்கை :"); //8
		$tList[]=array("Ownership :","හිමිකම   :","ஓனர்ஷிப் :"); //9
		$tList[]=array("Land Registration Number/Date :","ලියාපදිංචි කල අංකය   :","பதிவு எண் :"); //10
		$tList[]=array("Land Name :","ඉඩමේ නම   :","நிலங்கள் பெயர்:"); //11
		$tList[]=array("Plan Number :","පිඹුරු පතෙහි අංකය   :","திட்டம் எண் :"); //12
		$tList[]=array("Title Deed Number :","ඔප්පුවෙහි අංකය   :","தலைப்பு பத்திரத்தை எண் :"); //13
		$tList[]=array("Title Deed Date :","ඔප්පුවෙහි දිනය   :","தலைப்பு பத்திரத்தை தேதி :"); //14
		$tList[]=array("Nature of Land :","ඉඩමෙහි ස්භාවය   :","காணி இயற்கை :"); //15
		$tList[]=array("Area Measurement Type :","මිනුම් ඒකකය   :","பகுதி அளவீட்டு வகை :"); //16
		$tList[]=array("Area :","විශාලත්වය   :","பகுதி :"); //17
		$tList[]=array("Government Estimated Value (Rs.) :","තක්සේරු කල වටිනාකම   :","உத்தேச மதிப்பு :"); //18
		$tList[]=array("Previous Ownership :","ලබා ගත් ආයතනය   :","கையகப்படுத்தியது நிறுவனம் :"); //19
		$tList[]=array("Date of Acquisition :","ලබා ගත් දිනය   :","கையகப்படுத்தல் தேதி :"); //20
		$tList[]=array("Remarks :","සටහන්   :","குறிப்புரை :"); //21
		$tList[]=array("Assets Identification Number :","වත්කම් හදුනාගැනීමේ අංකය   :","சொத்துக்கள் அடையாள எண் :"); //22
		$tList[]=array("Reason for not Approve :","අනුමත නොකිරීමට හේතු   :","ஒப்புதல் இல்லை காரணம் :"); //23
                
                $tList[]=array("ESR Estimated Value (Rs.):","ඉදිකිරීමේ වියදම   :","கட்டுமான செலவு :"); //24
                $tList[]=array("Reference :","ඉදිකිරීමේ වියදම   :","கட்டுமான செலவு :"); //25
                
	
	case 2:
		$subMenu[]=array("Building Details List","ගොඩනැඟිලි විස්තර ලයිස්තුව","கட்டிடம் விவரங்கள் பெற"); //0
		$subMenu[]=array("Add Building Details","ගොඩනැඟිලි විස්තර ඇතුල් කිරීම","கட்டிடம் விவரம்"); //1
		$subMenu[]=array("Approve Details","විස්තර අනුමත කිරීම","விவரம் ஒப்புதல்"); //2
		$subMenu[]=array("Inquiry","විස්තර සෙවීම","விசாரணை"); //3
		$subMenu[]=array("Allow Modifications","විස්තර වෙනස් කිරීම","திருத்தங்கள் அனுமதி");//4
		
		$slideBar[]=array("Building Details","ගොඩනැඟිලි විස්තර","கட்டிடம் விவரம்"); //0
		$slideBar[]=array("Approve Building Details","ගොඩනැඟිලි අනුමැතිය","விவரங்கள் ஒப்புதல்"); //1
		$slideBar[]=array("Pending Approve Building","අනුමැතියට ඉදිරිපත් කල","ஒப்புதல் நிலுவையில்"); //2
		$slideBar[]=array("Approved Building","අනුමත කල ගොඩනැඟිලි","அங்கீகரிக்கப்பட்ட கட்டிடம்"); //3
		$slideBar[]=array("Approval Rejected","අනුමත නොකල ගොඩනැඟිලි","ஒப்புதல் நிராகரிக்கப்பட்டது"); //4
		$slideBar[]=array("Inquiry List","විස්තර සෙවීමේ ලයිස්තුව","விசாரணை பெற"); //5
		$slideBar[]=array("Modification Items List","වෙනස් කිරීමේ ලයිස්තුව","மாற்றம் பட்டிப்");//6
		
		$tList[]=array("Assets Center :","වත්කම් මධ්‍යස්ථානය   :","சொத்துக்கள் மையம் :"); //0
		$tList[]=array("Assets Unit :","වත්කම් ඒකකය   :","சொத்துக்கள் யூனிட் :"); //1
		$tList[]=array("Province :","පලාත   :","மாகாண :"); //2
		$tList[]=array("District :","දිස්ත්‍රික්කය   :","மாவட்ட :"); //3
		$tList[]=array("DS Division :","ප්‍රා. ලේ. කොට්ඨාශය   :","DS பிரிவு :"); //4
		$tList[]=array("GS Division :","ග්‍රා. සේ. කොට්ඨාශය   :","GS பிரிவு :"); //5
		$tList[]=array("Building Category :","ගොඩනැඟිලි වර්ගය   :"," :"); //6
		$tList[]=array("Assets No/Classification No :","වත්කම් / වර්ගීකරණ අංක   :","சொத்துக்கள் இல்லை / தள இல்லை :"); //7
		$tList[]=array("Nature of the Ownership :","හිමිකමේ ස්භාවය   :","உரிமையாளர் இயற்கை :"); //8
		$tList[]=array("Ownership :","හිමිකම   :","ஓனர்ஷிப் :"); //	9
		$tList[]=array("Name of Land :","ඉඩමෙහි නම    :","நிலங்கள் பெயர் :"); //10
		$tList[]=array("Name of Owner :","අයිතිකරුගේ නම   :","உரிமையாளர் பெயர் :"); //11
		$tList[]=array("Building Size :","ගොඩනැඟිල්ලේ ප්‍රමාණය   :","கட்டிடம் வகை :"); //12
		$tList[]=array("Number of Floors :","ගොඩනැඟිල්ලේ තට්ටු ප්‍රමාණය :","மாடிகளின் எண்ணிக்கை:"); //13
		$tList[]=array("Reg. Name of Owner :","ලියාපදිංචි කල අයිතිකරුගේ නම   :","ரெக். உரிமையாளர் பெயர் :"); //14
		$tList[]=array("Building Number :","ගොඩනැඟිල්ලෙහි අංකය   :","கட்டிடம் எண் :"); //15
		$tList[]=array("Plan Number :","පිඹුරු පතෙහි අංකය   :","திட்டம் எண் :"); //16
		$tList[]=array("Plan Date :","පිඹුරු පතෙහි දිනය   :","திட்டம் தேதி :"); //17
		$tList[]=array("Area Measurement Type :","මිනුම් ඒකකය   :","பகுதி அளவீட்டு வகை :"); //18
		$tList[]=array("Area :","විශාලත්වය   :","பகுதி :"); //19
		//$tList[]=array("ESR Construction Cost (Rs.):","ඉදිකිරීමේ වියදම   :","கட்டுமான செலவு :"); //20
                $tList[]=array("ESR Valuation Cost (Rs.):","ඉදිකිරීමේ වියදම   :","கட்டுமான செலவு :"); //20
		$tList[]=array("Additions & Improve. Cost (Rs.):","එකතු වූ වියදම්   :","கூட்டல் செலவு :"); //21
		$tList[]=array("Government Valuation Cost (Rs.):","තක්සේරු පිරිවැය   :","மதிப்பீட்டு செலவு :"); //22
		$tList[]=array("Previous Ownership :","ලබා ගත් ආයතනය   :","கையகப்படுத்தியது நிறுவனம் :"); //23
		$tList[]=array("Date of Acquisition :","ලබා ගත් දිනය   :","கையகப்படுத்தல் தேதி :"); //24
		$tList[]=array("Remarks :","සටහන්   :","குறிப்புரை :"); //25
		$tList[]=array("Assets Identification Number :","වත්කම් හදුනාගැනීමේ අංකය   :","சொத்துக்கள் அடையாள எண் :"); //26
		$tList[]=array("Reason for not Approve :","අනුමත නොකිරීමට හේතු   :","ஒப்புதல் இல்லை காரணம் :"); //27
                
                $tList[]=array("ESR Valuation Cost (Rs.):","ඉදිකිරීමේ වියදම   :","கட்டுமான செலவு :"); //28
                $tList[]=array("Reference :","ඉදිකිරීමේ වියදම   :","கட்டுமான செலவு :"); //29
	case 3:
		$subMenu[]=array("Details List","විස්තර ලයිස්තුව","விவரம் பெற");
		$subMenu[]=array("Add Details","විස්තර ඇතුල් කිරීම","விவரம்");
		$subMenu[]=array("Approve Details","විස්තර අනුමත කිරීම","விவரம் ஒப்புதல்");
		$subMenu[]=array("Disposal Details","අයෝග්‍ය කිරීම","நீக்கல் விவரம்");
		$subMenu[]=array("Transfer Details","හුවමාරු  කිරීම","டிரான்ஸ்பர் விவரம்");
		$subMenu[]=array("Allow Modifications","විස්තර වෙනස් කිරීම","திருத்தங்கள் அனுமதி");
		$subMenu[]=array("Inquiry","විස්තර සෙවීම","விசாரணை");
		$subMenu[]=array("Full List","සම්පූර්ණ ලයිස්තුව","முழு பட்டியல்");
		
		$slideBar[]=array("Transfer Details","හුවමාරු විස්තර","பரிமாற்ற விவரங்கள்");//0
		$slideBar[]=array("Disposal Details","අයෝග්‍ය විස්තර","நீக்கம் விவரம்");//1
		$slideBar[]=array("Insert Disposal","අයෝග්‍ය ඇතුලත්කිරීම","நுழைவு நீக்கம்");//2
		$slideBar[]=array("Pending Approve","අනුමැතියට ඉදිරිපත් කල","ஒப்புதல் நிலுவையில்");//3
		$slideBar[]=array("Inquiry Plant & Mec.","විමසීම් යන්ත්‍ර උපකරණ","விசாரணை");//4
		$slideBar[]=array("Approve Plant & Mach.","අනුමත කිරීම් යන්ත්‍ර උපකරණ","ஒப்புதல்");//5
		$slideBar[]=array("Approved Plant & Mac","අනුමත කල යන්ත්‍ර උපකරණ","ஒப்புதல்");//6
		$slideBar[]=array("Selected for Transfer","හුවමාරුව සඳහා තෝරාගත්","மாற்றம் தேர்ந்தெடுக்கப்பட்ட");//7
		$slideBar[]=array("Selected for Disposal","අයෝග්‍ය සඳහා තෝරාගත්","நீக்கம் தேர்ந்தெடுக்கப்பட்ட");//8
		$slideBar[]=array("Search List-Transfer","හුවමාරු විස්තර සෙවීම","தேடல் பட்டியல் - மாற்றம்");//9
		$slideBar[]=array("Search List-Disposal","අයෝග්‍ය විස්තර සෙවීම","தேடல் பட்டியல் - நீக்கம்");//10
		$slideBar[]=array("Confirm List - Transfer","තහවුරු ලයිස්තුව-හුවමාරු","பட்டியலில் உறுதிப்படுத்தவும் - பரிமாற்ற");//11
		$slideBar[]=array("Confirm List - Disposal","තහවුරු ලයිස්තුව-අයෝග්‍ය","பட்டியல் உறுதிப்படுத்தவும் - நீக்கம்");//12
		$slideBar[]=array("Approve List - Disposal","අනුමත ලයිස්තුව-අයෝග්‍ය","பட்டியல் ஒப்புதல் - நீக்கம்");//13
		$slideBar[]=array("Modification Items List","වෙනස් කිරීමේ ලයිස්තුව","மாற்றம் பட்டிப்");//14
		$slideBar[]=array("Plant & Machinery","යන්ත්‍ර උපකරණ","தேறிய வாடகை");//15
		$slideBar[]=array("Approval Rejected","අනුමැතිය ප්‍රතික්ෂේප කල","ஒப்புதல் நிராகரிக்கப்பட்டது"); //16
		$slideBar[]=array("Receive From Units","වෙනත් ඒකක වලින් ලැබුණු","மற்ற அலகுகள் பெறும்"); //17
		
		$slideBar[]=array("Select Items For Transfer","හුවමාරුව සඳහා භාන්ඩ තෝරාගැනීම","மாற்றம் செய்ய தேர்ந்தெடு"); //18
		$slideBar[]=array("Selected Items For Transfer","හුවමාරුව සඳහා තෝරගත් භාන්ඩ","டிரான்ஸ்பர் தேர்ந்தெடுக்கப்பட்டுள்ளன உபகரணங்கள்"); //19
		$slideBar[]=array("Confirm Items For Transfer","හුවමාරුව සඳහා තහවුරු කිරිම","மாற்றம் செய்ய உபகரணங்கள் உறுதிப்படுத்து"); //20
		$slideBar[]=array("Select Items For Disposal","අයෝග්‍ය කිරීම සඳහා භාන්ඩ තෝරාගැනීම","அகற்றல் தேர்ந்தெடு"); //21
		$slideBar[]=array("Selected Items For Disposal","අයෝග්‍ය කිරීම සඳහා තෝරා ගත් භාන්ඩ","நீக்கல் தேர்ந்தெடுக்கப்பட்டுள்ளன உபகரணங்கள்"); //22
		$slideBar[]=array("Confirm Items For Disposal","අයෝග්‍ය කිරීම සඳහා තහවුරු කිරීම","அகற்றல் உபகரணங்கள் உறுதிப்படுத்து"); //23
		$slideBar[]=array("Approve Disposals - Unit Wise","අයෝග්‍ය කිරිම සඳහා අනුමැතිය -Unit","அைற்றல்ைள் ஒப்புதல் - அளவு வைஸ்"); //24
		$slideBar[]=array("Approve Items For Disposal List","අයෝග්‍ය කිරිම සඳහා අනුමැතිය - All","நீக்கல் பட்டியலில் உபகரணங்கள் ஒப்புதல்"); //25
		$slideBar[]=array("Disposal List","අයෝග්‍ය කල භාන්ඩ වල ලයිස්තුව","நீக்கல் பெற"); //26
		$slideBar[]=array("Disposal Inquiry","අයෝග්‍ය කල භාන්ඩ විස්තර සෙවීම","நீக்கல் விசாரணை"); //27
		
		$tList[]=array("Assets Center :","වත්කම් මධ්‍යස්ථානය   :","சொத்துக்கள் மையம் :"); //0
		$tList[]=array("Assets Unit :","වත්කම් ඒකකය   :","சொத்துக்கள் யூனிட் :"); //1
		$tList[]=array("Main Category :","ප්‍රධාන ප්‍රවර්ගය  :","முதன்மை :"); //2
		$tList[]=array("Item Category :","භාන්ඩයේ ප්‍රවර්ගය  :","பொருள் வகை :"); //3
		$tList[]=array("Item Description :","භාන්ඩයේ විස්තරය  :","பொருள் விளக்கம் :"); //4
		$tList[]=array("Catalogue Number :","නාමාවලි අංකය  :","பெயர்ப்பட்டியல் எண் :"); //5
		$tList[]=array("Assets Number/Classification No:","වත්කම් / වර්ගීකරණ අංක   :","சொத்துக்கள் இல்லை / தள இல்லை :"); //6
		$tList[]=array("Ledger Number :","ලෙජර අංකය  :","லெட்ஜர் எண் :"); //7
		$tList[]=array("Ledger Folio Number :","ලෙජර පත්තිරු අංකය  :","லெட்ஜர் ஃபோலியோ எண் :"); //8
		$tList[]=array("Equipment Serial Number :","භාණ්ඩයේ අනුක්‍රමික අංකය  :","உபகரணங்கள் தொடர் எண் :"); //9
		$tList[]=array("Date of Procurement    :","මිලදී ගත් දිනය  :","வாங்கப்பட்டது தேதி :"); //10
		$tList[]=array("Quantity :"," ප්‍රමාණය :","அளவு :"); //11
		$tList[]=array("Capacity :","ධාරිතාව  :","கொள்ளளவு :"); //12
		$tList[]=array("Unit Value (Rs.):","ඒකකයක මිල  :","அலகு மதிப்பு :"); //13
		$tList[]=array("Previous Ownership :","ලබා ගත් ආයතනය   :","கையகப்படுத்தியது நிறுவனம் :"); //14
		$tList[]=array("Date of Receipt :","ලැබුණු දිනය  :","பெறப்பட்ட தேதி :"); //15
		$tList[]=array("Present Location :","භාණ්ඩය ඇති ස්ථානය  :","தற்போதைய இடம் :"); //16
		$tList[]=array("Remarks :","සටහන්   :","குறிப்புரை :"); //17
		$tList[]=array("Assets Identification Number :","වත්කම් හදුනාගැනීමේ අංකය   :","சொத்துக்கள் அடையாள எண் :"); //18
		$tList[]=array("Reason for not Approve :","අනුමත නොකිරීමට හේතු   :","ஒப்புதல் இல்லை காரணம் :"); //19
		$tList[]=array("Disposal Date  :","අයෝග්‍ය කරන දිනය   :","நீக்கம் தேதி:"); //20
		$tList[]=array("Reason for Disposal  :","අයෝග්‍ය කිරීමට හේතුව   :","நீக்கம் காரணம் :"); //21
		$tList[]=array("Approve for Disposal  :","අයෝග්‍ය කිරීම අනුමත කිරීම  :","நீக்கம் அனுமதி :"); //22
		$tList[]=array("Total Cost  :","මුළු මුදල  :","மொத்த செலவு :"); //23
		$tList[]=array("Select for Transfer  :","හුවමාරුව සඳහා තේරීම :","மாற்றம் வாய்ப்புகள் :"); //24
		$tList[]=array("Transfer Assets Center :","පිටත්කරන වත්කම් මධ්‍යස්ථානය  :","சொத்துக்கள் மையம் பரிமாற்றம் :"); //25
		$tList[]=array("Transfer Assets Unit :","පිටත්කරන වත්කම් ඒකකය :","சொத்துக்கள் பிரிவின் பரிமாற்றம் :"); //26
		$tList[]=array("Transfer Date  :","භාන්ඩය පිටත්කරන  දිනය :","மாற்றம் தேதி :"); //27
		$tList[]=array("Transfer Details  :","භාන්ඩය පිටත් කිරීමේ විස්තර :","பரிமாற்ற விவரங்கள் :"); //28
		$tList[]=array("Select for Disposal  :","අයෝග්‍ය කිරීම සඳහා තේරීම :","நீக்கம் தேர்ந்தெடுக்கவும் :"); //29
		$tList[]=array("Search by :","විමසන ආකාරය  :","மூலம் தேடல் :"); //30
		$tList[]=array("Condemnation Board - Ref:","අයෝග්‍ය කිරිමේ මණ්ඩල ලිපිය  - Ref.:","வருடாந்த எதிர்ப்பே வாரியம் :"); //31
		$tList[]=array("Destruction Board - Ref:","විනාශකිරීමේ මණ්ඩලය - Ref.:","அழிவு வாரியம் :"); //32
		$tList[]=array("Nature of the Ownership :","හිමිකමේ ස්භාවය   :","உரிமையாளர் இயற்கை :"); //33
		
	case 4:
		$subMenu[]=array("Details List","විස්තර ලයිස්තුව","விவரம் பெற"); //0
		$subMenu[]=array("Add Details","විස්තර ඇතුල් කිරීම","விவரம்"); //1
		$subMenu[]=array("Approve Details","විස්තර අනුමත කිරීම","விவரம் ஒப்புதல்"); //2
		$subMenu[]=array("Disposal Details","අයෝග්‍ය කිරීම","நீக்கல் விவரம்"); //3
		$subMenu[]=array("Transfer Details","හුවමාරු  කිරීම","டிரான்ஸ்பர் விவரம்"); //4
		$subMenu[]=array("Allow Modifications","විස්තර වෙනස් කිරීම","திருத்தங்கள் அனுமதி"); //5
		$subMenu[]=array("Inquiry","විස්තර සෙවීම","விசாரணை"); //6
		$subMenu[]=array("Full List","සම්පූර්ණ ලයිස්තුව","முழு பட்டியல்"); //7
		
		$slideBar[]=array("Transfer Details","හුවමාරු විස්තර","பரிமாற்ற விவரங்கள்");//0
		$slideBar[]=array("Disposal Details","අයෝග්‍ය විස්තර","நீக்கம் விவரம்");//1
		$slideBar[]=array("Insert Disposal","අයෝග්‍ය ඇතුලත්කිරීම","நுழைவு நீக்கம்");//2
		$slideBar[]=array("Pending Approve","අනුමැතියට ඉදිරිපත් කල","ஒப்புதல் நிலுவையில்");//3
		$slideBar[]=array("Inquiry Office Equ.","විමසීම් කාර්ය්‍යාලීය උපකරණ","விசாரணை");//4
		$slideBar[]=array("Approve Office Equ.","අනුමත කිරීම් කාර්ය්‍යාලීය උපකරණ","ஒப்புதல்");//5
		$slideBar[]=array("Approved Office Equ.","අනුමත කල කාර්ය්‍යාලීය උපකරණ","ஒப்புதல்");//6
		$slideBar[]=array("Selected for Transfer","හුවමාරුව සඳහා තෝරාගත්","மாற்றம் தேர்ந்தெடுக்கப்பட்ட");//7
		$slideBar[]=array("Selected for Disposal","අයෝග්‍ය සඳහා තෝරාගත්","நீக்கம் தேர்ந்தெடுக்கப்பட்ட");//8
		$slideBar[]=array("Search List-Transfer","හුවමාරු විස්තර සෙවීම","தேடல் பட்டியல் - மாற்றம்");//9
		$slideBar[]=array("Search List-Disposal","අයෝග්‍ය විස්තර සෙවීම","தேடல் பட்டியல் - நீக்கம்");//10
		$slideBar[]=array("Confirm List - Transfer","තහවුරු ලයිස්තුව-හුවමාරු","பட்டியலில் உறுதிப்படுத்தவும் - பரிமாற்ற");//11
		$slideBar[]=array("Confirm List - Disposal","තහවුරු ලයිස්තුව-අයෝග්‍ය","பட்டியல் உறுதிப்படுத்தவும் - நீக்கம்");//12
		$slideBar[]=array("Approve List - Disposal","අනුමත ලයිස්තුව-අයෝග්‍ය","பட்டியல் ஒப்புதல் - நீக்கம்");//13
		$slideBar[]=array("Modification Items List","වෙනස් කිරීමේ ලයිස්තුව","மாற்றம் பட்டிப்");//14
		$slideBar[]=array("Office Equipments","කාර්ය්‍යාලීය උපකරණ","தேறிய வாடகை");//15
		$slideBar[]=array("Approval Rejected","අනුමැතිය ප්‍රතික්ෂේප කල","ஒப்புதல் நிராகரிக்கப்பட்டது"); //16
		$slideBar[]=array("Receive From Units","වෙනත් ඒකක වලින් ලැබුණු","மற்ற அலகுகள் பெறும்"); //17
		$slideBar[]=array("Select Items For Transfer","හුවමාරුව සඳහා භාන්ඩ තෝරාගැනීම","மாற்றம் செய்ய தேர்ந்தெடு"); //18
		$slideBar[]=array("Selected Items For Transfer","හුවමාරුව සඳහා තෝරගත් භාන්ඩ","டிரான்ஸ்பர் தேர்ந்தெடுக்கப்பட்டுள்ளன உபகரணங்கள்"); //19
		$slideBar[]=array("Confirm Items For Transfer","හුවමාරුව සඳහා තහවුරු කිරිම","மாற்றம் செய்ய உபகரணங்கள் உறுதிப்படுத்து"); //20
		$slideBar[]=array("Select Items For Disposal","අයෝග්‍ය කිරීම සඳහා භාන්ඩ තෝරාගැනීම","அகற்றல் தேர்ந்தெடு"); //21
		$slideBar[]=array("Selected Items For Disposal","අයෝග්‍ය කිරීම සඳහා තෝරා ගත් භාන්ඩ","நீக்கல் தேர்ந்தெடுக்கப்பட்டுள்ளன உபகரணங்கள்"); //22
		$slideBar[]=array("Confirm Items For Disposal","අයෝග්‍ය කිරීම සඳහා තහවුරු කිරීම","அகற்றல் உபகரணங்கள் உறுதிப்படுத்து"); //23
		$slideBar[]=array("Approve Disposals - Unit Wise","අයෝග්‍ය කිරිම සඳහා අනුමැතිය -Unit","அைற்றல்ைள் ஒப்புதல் - அளவு வைஸ்"); //24
		$slideBar[]=array("Approve Items For Disposal List","අයෝග්‍ය කිරිම සඳහා අනුමැතිය - All","நீக்கல் பட்டியலில் உபகரணங்கள் ஒப்புதல்"); //25
		$slideBar[]=array("Disposal List","අයෝග්‍ය කල භාන්ඩ වල ලයිස්තුව","நீக்கல் பெற"); //26
		$slideBar[]=array("Disposal Inquiry","අයෝග්‍ය කල භාන්ඩ විස්තර සෙවීම","நீக்கல் விசாரணை"); //27
		
		$tList[]=array("Assets Center :","වත්කම් මධ්‍යස්ථානය   :","சொத்துக்கள் மையம் :"); //0
		$tList[]=array("Assets Unit :","වත්කම් ඒකකය   :","சொத்துக்கள் யூனிட் :"); //1
		$tList[]=array("Main Category :","ප්‍රධාන ප්‍රවර්ගය  :","முதன்மை :"); //2
		$tList[]=array("Item Category :","භාන්ඩයේ ප්‍රවර්ගය  :","பொருள் வகை :"); //3
		$tList[]=array("Item Description :","භාන්ඩයේ විස්තරය  :","பொருள் விளக்கம் :"); //4
		$tList[]=array("Catalogue Number :","නාමාවලි අංකය  :","பெயர்ப்பட்டியல் எண் :"); //5
		$tList[]=array("Assets Number/Classification No:","වත්කම් / වර්ගීකරණ අංක   :","சொத்துக்கள் இல்லை / தள இல்லை :"); //6
		$tList[]=array("Ledger Number :","ලෙජර අංකය  :","லெட்ஜர் எண் :"); //7
		$tList[]=array("Ledger Folio Number :","ලෙජර පත්තිරු අංකය  :","லெட்ஜர் ஃபோலியோ எண் :"); //8
		$tList[]=array("Equipment Serial Number :","භාණ්ඩයේ අනුක්‍රමික අංකය  :","உபகரணங்கள் தொடர் எண் :"); //9
		$tList[]=array("Date of Procurement    :","මිලදී ගත් දිනය  :","வாங்கப்பட்டது தேதி :"); //10
		$tList[]=array("Quantity :"," ප්‍රමාණය :","அளவு :"); //11
		$tList[]=array("Capacity :","ධාරිතාව  :","கொள்ளளவு :"); //12
		$tList[]=array("Unit Value (Rs.):","ඒකකයක මිල  :","அலகு மதிப்பு :"); //13
		$tList[]=array("Previous Ownership :","ලබා ගත් ආයතනය   :","கையகப்படுத்தியது நிறுவனம் :"); //14
		$tList[]=array("Date of Receipt :","ලැබුණු දිනය  :","பெறப்பட்ட தேதி :"); //15
		$tList[]=array("Present Location :","භාණ්ඩය ඇති ස්ථානය  :","தற்போதைய இடம் :"); //16
		$tList[]=array("Remarks :","සටහන්   :","குறிப்புரை :"); //17
		$tList[]=array("Assets Identification Number :","වත්කම් හදුනාගැනීමේ අංකය   :","சொத்துக்கள் அடையாள எண் :"); //18
		$tList[]=array("Reason for not Approve :","අනුමත නොකිරීමට හේතු   :","ஒப்புதல் இல்லை காரணம் :"); //19
		$tList[]=array("Disposal Date  :","අයෝග්‍ය කරන දිනය   :","நீக்கம் தேதி:"); //20
		$tList[]=array("Reason for Disposal  :","අයෝග්‍ය කිරීමට හේතුව   :","நீக்கம் காரணம் :"); //21
		$tList[]=array("Approve for Disposal  :","අයෝග්‍ය කිරීම අනුමත කිරීම  :","நீக்கம் அனுமதி :"); //22
		$tList[]=array("Total Cost  :","මුළු මුදල  :","மொத்த செலவு :"); //23
		$tList[]=array("Select for Transfer  :","හුවමාරුව සඳහා තේරීම :","மாற்றம் வாய்ப்புகள் :"); //24
		$tList[]=array("Transfer Assets Center :","පිටත්කරන වත්කම් මධ්‍යස්ථානය  :","சொத்துக்கள் மையம் பரிமாற்றம் :"); //25
		$tList[]=array("Transfer Assets Unit :","පිටත්කරන වත්කම් ඒකකය :","சொத்துக்கள் பிரிவின் பரிமாற்றம் :"); //26
		$tList[]=array("Transfer Date  :","භාන්ඩය පිටත්කරන  දිනය :","மாற்றம் தேதி :"); //27
		$tList[]=array("Transfer Details  :","භාන්ඩය පිටත් කිරීමේ විස්තර :","பரிமாற்ற விவரங்கள் :"); //28
		$tList[]=array("Select for Disposal  :","අයෝග්‍ය කිරීම සඳහා තේරීම :","நீக்கம் தேர்ந்தெடுக்கவும் :"); //29
		$tList[]=array("Search by :","විමසන ආකාරය  :","மூலம் தேடல் :"); //30
		$tList[]=array("Condemnation Board - Ref:","අයෝග්‍ය කිරිමේ මණ්ඩල ලිපිය  - Ref.:","வருடாந்த எதிர்ப்பே வாரியம் :"); //31
		$tList[]=array("Destruction Board - Ref:","විනාශකිරීමේ මණ්ඩලය - Ref.:","அழிவு வாரியம் :"); //32
		$tList[]=array("Nature of the Ownership :","හිමිකමේ ස්භාවය   :","உரிமையாளர் இயற்கை :"); //33		
		
	case 5:
		$subMenu[]=array("Details List","විස්තර ලයිස්තුව","விவரம் பெற");
		$subMenu[]=array("Add Details","විස්තර ඇතුල් කිරීම","விவரம்");
		$subMenu[]=array("Approve Details","විස්තර අනුමත කිරීම","விவரம் ஒப்புதல்");
		$subMenu[]=array("Disposal Details","අයෝග්‍ය කිරීම","நீக்கல் விவரம்");
		$subMenu[]=array("Transfer Details","හුවමාරු  කිරීම","டிரான்ஸ்பர் விவரம்");
		$subMenu[]=array("Allow Modifications","විස්තර වෙනස් කිරීම","திருத்தங்கள் அனுமதி");
		$subMenu[]=array("Inquiry","විස්තර සෙවීම","விசாரணை");	
		
		$slideBar[]=array("Transfer Details","හුවමාරු විස්තර","பரிமாற்ற விவரங்கள்");//0
		$slideBar[]=array("Disposal Details","අයෝග්‍ය විස්තර","நீக்கம் விவரம்");//1
		$slideBar[]=array("Insert Disposal","අයෝග්‍ය ඇතුලත්කිරීම","நுழைவு நீக்கம்");//2
		$slideBar[]=array("Pending Approve","අනුමැතියට ඉදිරිපත් කල","ஒப்புதல் நிலுவையில்");//3
		$slideBar[]=array("Inquiry Vehicles","විමසීම් වාහන","விசாரணை வாகனங்கள்");//4
		$slideBar[]=array("Approve Vehicles","අනුමත කිරීම් වාහන","வாகனங்கள் ஒப்புதல்");//5
		$slideBar[]=array("Approved Vehicles","අනුමත කල වාහන","Approved வாகனங்கள்");//6
		$slideBar[]=array("Selected for Transfer","හුවමාරුව සඳහා තෝරාගත්","மாற்றம் தேர்ந்தெடுக்கப்பட்ட");//7
		$slideBar[]=array("Selected for Disposal","අයෝග්‍ය සඳහා තෝරාගත්","நீக்கம் தேர்ந்தெடுக்கப்பட்ட");//8
		$slideBar[]=array("Search List-Transfer","හුවමාරු විස්තර සෙවීම","தேடல் பட்டியல் - மாற்றம்");//9
		$slideBar[]=array("Search List-Disposal","අයෝග්‍ය විස්තර සෙවීම","தேடல் பட்டியல் - நீக்கம்");//10
		$slideBar[]=array("Confirm List - Transfer","තහවුරු ලයිස්තුව-හුවමාරු","பட்டியலில் உறுதிப்படுத்தவும் - பரிமாற்ற");//11
		$slideBar[]=array("Confirm List - Disposal","තහවුරු ලයිස්තුව-අයෝග්‍ය","பட்டியல் உறுதிப்படுத்தவும் - நீக்கம்");//12
		$slideBar[]=array("Approve List - Disposal","අනුමත ලයිස්තුව-අයෝග්‍ය","பட்டியல் ஒப்புதல் - நீக்கம்");//13
		$slideBar[]=array("Modification Items List","වෙනස් කිරීමේ ලයිස්තුව","மாற்றம் பட்டிப்");//14
		$slideBar[]=array("Vehicles Details","වාහන විස්තර","வாகனங்கள் விவரம்");//15
		$slideBar[]=array("Approval Rejected","අනුමැතිය ප්‍රතික්ෂේප කල","ஒப்புதல் நிராகரிக்கப்பட்டது"); //16
		$slideBar[]=array("Receive From Units","වෙනත් ඒකක වලින් ලැබුණු","மற்ற அலகுகள் பெறும்"); //17
		$slideBar[]=array("Select Items For Transfer","හුවමාරුව සඳහා භාන්ඩ තෝරාගැනීම","மாற்றம் செய்ய தேர்ந்தெடு"); //18
		$slideBar[]=array("Selected Items For Transfer","හුවමාරුව සඳහා තෝරගත් භාන්ඩ","டிரான்ஸ்பர் தேர்ந்தெடுக்கப்பட்டுள்ளன உபகரணங்கள்"); //19
		$slideBar[]=array("Confirm Items For Transfer","හුවමාරුව සඳහා තහවුරු කිරිම","மாற்றம் செய்ய உபகரணங்கள் உறுதிப்படுத்து"); //20
		$slideBar[]=array("Select Items For Disposal","අයෝග්‍ය කිරීම සඳහා භාන්ඩ තෝරාගැනීම","அகற்றல் தேர்ந்தெடு"); //21
		$slideBar[]=array("Selected Items For Disposal","අයෝග්‍ය කිරීම සඳහා තෝරා ගත් භාන්ඩ","நீக்கல் தேர்ந்தெடுக்கப்பட்டுள்ளன உபகரணங்கள்"); //22
		$slideBar[]=array("Confirm Items For Disposal","අයෝග්‍ය කිරීම සඳහා තහවුරු කිරීම","அகற்றல் உபகரணங்கள் உறுதிப்படுத்து"); //23
		$slideBar[]=array("Approve Disposals - Unit Wise","අයෝග්‍ය කිරිම සඳහා අනුමැතිය -Unit","அைற்றல்ைள் ஒப்புதல் - அளவு வைஸ்"); //24
		$slideBar[]=array("Approve Items For Disposal List","අයෝග්‍ය කිරිම සඳහා අනුමැතිය - All","நீக்கல் பட்டியலில் உபகரணங்கள் ஒப்புதல்"); //25
		$slideBar[]=array("Disposal List","අයෝග්‍ය කල භාන්ඩ වල ලයිස්තුව","நீக்கல் பெற"); //26
		$slideBar[]=array("Disposal Inquiry","අයෝග්‍ය කල භාන්ඩ විස්තර සෙවීම","நீக்கல் விசாரணை"); //27
		
		$tList[]=array("Assets Center :","වත්කම් මධ්‍යස්ථානය   :","சொத்துக்கள் மையம் :"); //0
		$tList[]=array("Assets Unit :","වත්කම් ඒකකය   :","சொத்துக்கள் யூனிட் :"); //1
		$tList[]=array("Main Category :","ප්‍රධාන ප්‍රවර්ගය  :","முதன்மை :"); //2
		$tList[]=array("Item Category :","භාන්ඩයේ ප්‍රවර්ගය  :","பொருள் வகை :"); //3
		$tList[]=array("Item Description :","භාන්ඩයේ විස්තරය  :","பொருள் விளக்கம் :"); //4
		$tList[]=array("Catalogue Number :","නාමාවලි අංකය  :","பெயர்ப்பட்டியல் எண் :"); //5
		$tList[]=array("Assets No:","වත්කම් අංකය :","சொத்துக்கள் எண் :"); //6
		$tList[]=array("Engine Number :","ඇන්ජින් අංකය :","எஞ்சின் எண் :"); //7
		$tList[]=array("Chassis Number :","චැසි අංකය :","சேஸ் எண் :"); //8
		$tList[]=array("Year of Manufacture :","නිෂ්පාදිත වර්ෂය :","ஆண்டு உற்பத்தி :"); //9
		$tList[]=array("Ownership :","හිමිකම :","ஓனர்ஷிப் :"); //10
		$tList[]=array("Army Number :","යුහ අංකය :","இராணுவ எண் :"); //11
		$tList[]=array("Civil Number :","සිවිල් අංකය :","சிவில் எண் :"); //12
		$tList[]=array("Type of Fuel :","ඉන්ධන වර්ගය :","எரிபொருள் :"); //13
		$tList[]=array("Date of Procurement    :","මිලදී ගත් දිනය  :","வாங்கப்பட்டது தேதி :"); //14
		$tList[]=array("Purchased Unit Value (Rs.):","ඒකකයක මිල  :","அலகு மதிப்பு :"); //15
		$tList[]=array("Engine Capacity :","අශ්ව බල  :","குதிரை பவர் :"); //16
		$tList[]=array("Tare Weight:","තාරබර :","தாரே :"); //17
		$tList[]=array("Previous Ownership :","ලබා ගත් ආයතනය   :","கையகப்படுத்தியது நிறுவனம் :"); //18
		$tList[]=array("Date of Receipt :","ලැබුණු දිනය  :","பெறப்பட்ட தேதி :"); //19
		$tList[]=array("Present Location :","වාහනය ඇති ස්ථානය  :","தற்போதைய இடம் :"); //20
		$tList[]=array("Remarks :","සටහන්   :","குறிப்புரை :"); //21
		$tList[]=array("Assets Identification Number :","වත්කම් හදුනාගැනීමේ අංකය   :","சொத்துக்கள் அடையாள எண் :"); //22
		$tList[]=array("Reason for not Approve :","අනුමත නොකිරීමට හේතු   :","ஒப்புதல் இல்லை காரணம் :"); //23
		$tList[]=array("Select for Disposal  :","අයෝග්‍ය කිරීම සඳහා තේරීම :","நீக்கம் தேர்ந்தெடுக்கவும் :"); //24
		$tList[]=array("Disposal Date  :","අයෝග්‍ය කරන දිනය   :","நீக்கம் தேதி:"); //25
		$tList[]=array("Reason for Disposal  :","අයෝග්‍ය කිරීමට හේතුව   :","நீக்கம் காரணம் :"); //26
		$tList[]=array("Approve for Disposal  :","අයෝග්‍ය කිරීම අනුමත කිරීම  :","நீக்கம் அனுமதி :"); //27
		$tList[]=array("Confirm for Disposal  :","අයෝග්‍ය කිරීම තහවුරු කිරීම  :","அகற்றல் உறுதிப்படுத்தவும் :"); //28
		$tList[]=array("Search by :","විමසන ආකාරය  :","மூலம் தேடல் :"); //29
		$tList[]=array("Condemnation Board - Ref:","අයෝග්‍ය කිරිමේ මණ්ඩල ලිපිය  - Ref.:","வருடாந்த எதிர்ப்பே வாரியம் :"); //30
		$tList[]=array("Destruction Board - Ref:","විනාශකිරීමේ මණ්ඩලය - Ref.:","அழிவு வாரியம் :"); //31
		$tList[]=array("Nature of the Ownership :","හිමිකමේ ස්භාවය   :","உரிமையாளர் இயற்கை :"); //32
                 $tList[]=array("Capital Repair Cost :","සටහන්   :","குறிப்புரை :"); //33
		
	case 9:
		$subMenu[]=array("Details List","විස්තර ලයිස්තුව","விவரம் பெற");
		$subMenu[]=array("Add vehicle Tender Details","වාහන ටෙන්ඩර් විස්තර ඇතුල් කිරීම","வாகன டெண்டர் விவரம்");
		$subMenu[]=array("Add General Goods Tender Details","පොදු භාන්ඩ ටෙන්ඩර් විස්තර ඇතුල් කිරීම","பொது பொருட்கள் டெண்டர் விவரம்");
		
		$tList[]=array("Army Number :","යුහ අංකය :","இராணுவ எண் :"); //0		
		$tList[]=array("Main Category :","ප්‍රධාන ප්‍රවර්ගය  :","முதன்மை :"); //1
		$tList[]=array("Item Category :","භාන්ඩයේ ප්‍රවර්ගය  :","பொருள் வகை :"); //2
		$tList[]=array("Item Description :","භාන්ඩයේ විස්තරය  :","பொருள் விளக்கம் :"); //3
		$tList[]=array("Catalogue Number :","නාමාවලි අංකය  :","பெயர்ப்பட்டியல் எண் :"); //4
		$tList[]=array("Make/Model/Assets No:","නිෂ්පා./මාදිලිය/වත්කම් අංකය :","மேட் / மாடல் / சொத்துக்கள் எண் :"); //5
		$tList[]=array("Engine Number :","ඇන්ජින් අංකය :","எஞ்சின் எண் :"); //6
		$tList[]=array("Chassis Number :","චැසි අංකය :","சேஸ் எண் :"); //7
		$tList[]=array("Year manufactured :","නිෂ්පාදිත වර්ෂය :","ஆண்டு உற்பத்தி :"); //8
		$tList[]=array("Estimated Value (Rs.) :","තක්සේරු වටිනාකම :","மதிப்பு :"); //9
		$tList[]=array("Tender Value :","ටෙන්ඩර් වටිනාකම :","டெண்டர் மதிப்பு :"); //10
		$tList[]=array("Buyer's NIC No. :","ගැනුම්කරුගේ ජා.හැ.අ. :","வாங்குபவர் தேசிய அடையாள அட்டை எண் :"); //11
		$tList[]=array("Buyer's Name :","ගැනුම්කරුගේ නම :","வாங்குபவர் பெயர் :"); //12
		$tList[]=array("Buyer's Address :","ගැනුම්කරුගේ ලිපිනය :","வாங்குபவர் முகவரி :"); //13
		$tList[]=array("Remarks :","සටහන්   :","குறிப்புரை :"); //14
               
	}
	
?>