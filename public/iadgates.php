<html>
  <head>
    <title>vZDC - KIAD Gates In Use</title>
	<style>
	body {
   	 background-color: #000000;
	}
	</style>
<?php
//include("header.php");
?>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-44798345-1', 'vzdc.org');
      ga('send', 'pageview');
    
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTPke2h0fM42Ufrv3h_OksmuuEEihPt8Q"></script>
    <script type="text/javascript" src="maplabel-compiled.js"></script>
    <script type="text/javascript">
    //<![CDATA[
    
    var copyrightNode;

    var markersArray = [];
    var FDBArray = [];
    var ZDCArea;
    
    var ZDCCoords = [
      new google.maps.LatLng(34.84218,-80.13043),
      new google.maps.LatLng(35.36138,-79.78922),
      new google.maps.LatLng(36.08671,-79.74100),
      new google.maps.LatLng(37.33099,-80.63072),
      new google.maps.LatLng(37.30330,-80.74487),
      new google.maps.LatLng(37.47035,-80.83775),
      new google.maps.LatLng(38.76632,-80.56513),
      new google.maps.LatLng(39.16591,-80.39940),
      new google.maps.LatLng(39.17086,-79.89054),
      new google.maps.LatLng(39.36922,-79.53773),
      new google.maps.LatLng(39.84961,-77.93114),
      new google.maps.LatLng(39.87933,-77.15751),
      new google.maps.LatLng(39.68900,-77.16428),
      new google.maps.LatLng(39.69745,-77.35562),
      new google.maps.LatLng(39.44490,-77.10310),
      new google.maps.LatLng(39.38429,-76.81173),
      new google.maps.LatLng(39.38954,-76.34183),
      new google.maps.LatLng(39.59152,-76.02692),
      new google.maps.LatLng(39.25770,-75.83631),
      new google.maps.LatLng(39.62069,-74.98601),
      new google.maps.LatLng(39.64762,-74.77344),
      new google.maps.LatLng(39.65249,-74.45261),
      new google.maps.LatLng(39.58915,-74.48832),
      new google.maps.LatLng(39.57228,-74.18629),
      new google.maps.LatLng(39.02618,-73.64949),
      new google.maps.LatLng(38.53143,-73.97473),
      new google.maps.LatLng(37.06305,-74.54369),
      new google.maps.LatLng(35.44713,-74.87064),
      new google.maps.LatLng(35.33281,-75.16455),
      new google.maps.LatLng(33.12753,-76.97420),
      new google.maps.LatLng(34.43293,-78.72476),
      new google.maps.LatLng(34.43810,-79.31027),
      new google.maps.LatLng(34.84140,-79.88813)
    ];

//////ADDD    
    var gatesMap = {};
    gatesMap['B_76'] = { center: new google.maps.LatLng(38.94817304,-77.4544107913971), radius: 23 };
    gatesMap['B_78'] = { center: new google.maps.LatLng(38.94824613,-77.45488420128822), radius: 23 };
    gatesMap['B_74'] = { center: new google.maps.LatLng(38.9481613,-77.45388865470886), radius: 23 };
    gatesMap['B_72'] = { center: new google.maps.LatLng(38.94830614,-77.45333030819893), radius: 23 };
    gatesMap['B_70'] = { center: new google.maps.LatLng(38.9482183,-77.45287030935287), radius: 23 };
    gatesMap['B_68'] = { center: new google.maps.LatLng(38.94817036,-77.45247066020966), radius: 23 };
    gatesMap['B_66'] = { center: new google.maps.LatLng(38.94822299,-77.45203077793121), radius: 23 };
    gatesMap['B_64'] = { center: new google.maps.LatLng(38.9481318,-77.45154082775116), radius: 23 };
    gatesMap['B_50'] = { center: new google.maps.LatLng(38.94817807,-77.45093911886215), radius: 23 };
    gatesMap['B_48'] = { center: new google.maps.LatLng(38.94814789,-77.4503892660141), radius: 23 };
    gatesMap['B_46'] = { center: new google.maps.LatLng(38.94819617,-77.4499574303627), radius: 23 };
    gatesMap['B_44'] = { center: new google.maps.LatLng(38.94808285,-77.44931682944298), radius: 36 };
    gatesMap['B_40'] = { center: new google.maps.LatLng(38.94817606,-77.44836419820786), radius: 36 };
    gatesMap['A_32'] = { center: new google.maps.LatLng(38.94818075,-77.44737088680267), radius: 36 };
    gatesMap['A_26'] = { center: new google.maps.LatLng(38.94819349,-77.44645357131958), radius: 36 };
    gatesMap['A_22'] = { center: new google.maps.LatLng(38.94810162,-77.44567483663559), radius: 41 };
    gatesMap['A_16'] = { center: new google.maps.LatLng(38.94815125,-77.4447575211525), radius: 36 };
    gatesMap['A_15'] = { center: new google.maps.LatLng(38.94934114,-77.44471281766891), radius: 36 };
    gatesMap['A_19'] = { center: new google.maps.LatLng(38.94937433,-77.44551748037338), radius: 36 };
    gatesMap['A_21'] = { center: new google.maps.LatLng(38.94931499,-77.44616210460663), radius: 18 };
    gatesMap['A_23'] = { center: new google.maps.LatLng(38.94937266,-77.44660958647728), radius: 18 };
    gatesMap['A_31'] = { center: new google.maps.LatLng(38.94936696,-77.44730651378632), radius: 36 };
    gatesMap['B_37'] = { center: new google.maps.LatLng(38.94936059,-77.44833379983902), radius: 36 };
    gatesMap['B_41'] = { center: new google.maps.LatLng(38.94935489,-77.4493034183979), radius: 36 };
    gatesMap['B_45'] = { center: new google.maps.LatLng(38.94940484,-77.45020508766174), radius: 36 };
    gatesMap['B_51'] = { center: new google.maps.LatLng(38.94936897,-77.45112150907516), radius: 36 };
    gatesMap['B_65'] = { center: new google.maps.LatLng(38.94932203,-77.45187923312187), radius: 23 };
    gatesMap['B_67'] = { center: new google.maps.LatLng(38.94941457,-77.45227843523026), radius: 23 };
    gatesMap['B_69'] = { center: new google.maps.LatLng(38.94933544,-77.45275855064392), radius: 23 };
    gatesMap['B_71'] = { center: new google.maps.LatLng(38.94931566,-77.45327532291412), radius: 23 };
    gatesMap['B_73'] = { center: new google.maps.LatLng(38.94926403,-77.45380818843842), radius: 23 };
    gatesMap['B_75'] = { center: new google.maps.LatLng(38.949375,-77.45431289076805), radius: 23 };
    gatesMap['B_79'] = { center: new google.maps.LatLng(38.94931331,-77.45484754443169), radius: 23 };
    gatesMap['A_501'] = { center: new google.maps.LatLng(38.94900151,-77.44340658187866), radius: 16 };
    gatesMap['A_502'] = { center: new google.maps.LatLng(38.94927979,-77.44338423013687), radius: 16 };
    gatesMap['A_503'] = { center: new google.maps.LatLng(38.94953661,-77.44328275322914), radius: 16 };
    gatesMap['A_504'] = { center: new google.maps.LatLng(38.9495299,-77.44300648570061), radius: 16 };
    gatesMap['A_505'] = { center: new google.maps.LatLng(38.94925866,-77.44291082024574), radius: 16 };
    gatesMap['A_506'] = { center: new google.maps.LatLng(38.94901089,-77.4428741633892), radius: 16 };
    gatesMap['A_301'] = { center: new google.maps.LatLng(38.94900922,-77.44244635105133), radius: 16 };
    gatesMap['A_302'] = { center: new google.maps.LatLng(38.94927409,-77.44241282343864), radius: 16 };
    gatesMap['A_303'] = { center: new google.maps.LatLng(38.94953493,-77.44231402873993), radius: 16 };
    gatesMap['A_304'] = { center: new google.maps.LatLng(38.94952957,-77.44204089045525), radius: 16 };
    gatesMap['A_305'] = { center: new google.maps.LatLng(38.94925833,-77.44194701313972), radius: 16 };
    gatesMap['A_306'] = { center: new google.maps.LatLng(38.94900922,-77.4419054389), radius: 16 };
    gatesMap['A_101'] = { center: new google.maps.LatLng(38.94900654,-77.4414610862732), radius: 16 };
    gatesMap['A_102'] = { center: new google.maps.LatLng(38.94927509,-77.44143068790436), radius: 16 };
    gatesMap['A_103'] = { center: new google.maps.LatLng(38.9495356,-77.4413350224495), radius: 16 };
    gatesMap['A_104'] = { center: new google.maps.LatLng(38.94952755,-77.44105964899063), radius: 16 };
    gatesMap['A_105'] = { center: new google.maps.LatLng(38.94925598,-77.44096711277962), radius: 16 };
    gatesMap['A_106'] = { center: new google.maps.LatLng(38.94901592,-77.44090989232063), radius: 16 };
    gatesMap['A_107'] = { center: new google.maps.LatLng(38.94887544,-77.44061082601547), radius: 16 };
    gatesMap['A_207'] = { center: new google.maps.LatLng(38.94853111,-77.44060680270195), radius: 16 };
    gatesMap['A_206'] = { center: new google.maps.LatLng(38.94842517,-77.44091749191284), radius: 16 };
    gatesMap['A_205'] = { center: new google.maps.LatLng(38.9481613,-77.44096040725708), radius: 16 };
    gatesMap['A_204'] = { center: new google.maps.LatLng(38.94789476,-77.44104981422424), radius: 16 };
    gatesMap['A_203'] = { center: new google.maps.LatLng(38.94789945,-77.4413238465786), radius: 16 };
    gatesMap['A_202'] = { center: new google.maps.LatLng(38.94817237,-77.44142264127731), radius: 16 };
    gatesMap['A_201'] = { center: new google.maps.LatLng(38.94842718,-77.44146510958672), radius: 16 };
    gatesMap['A_406'] = { center: new google.maps.LatLng(38.94842282,-77.44192108511925), radius: 16 };
    gatesMap['A_405'] = { center: new google.maps.LatLng(38.94815125,-77.44193315505981), radius: 16 };
    gatesMap['A_404'] = { center: new google.maps.LatLng(38.94788537,-77.44202837347984), radius: 16 };
    gatesMap['A_403'] = { center: new google.maps.LatLng(38.94788805,-77.4423037469387), radius: 16 };
    gatesMap['A_402'] = { center: new google.maps.LatLng(38.94816633,-77.44239717721939), radius: 16 };
    gatesMap['A_401'] = { center: new google.maps.LatLng(38.94841511,-77.44244009256363), radius: 16 };
    gatesMap['A_605'] = { center: new google.maps.LatLng(38.94842047,-77.44288712739944), radius: 16 };
    gatesMap['A_604'] = { center: new google.maps.LatLng(38.94815426,-77.4429215490818), radius: 16 };
    gatesMap['A_603'] = { center: new google.maps.LatLng(38.94787464,-77.4430239200592), radius: 16 };
    gatesMap['A_602'] = { center: new google.maps.LatLng(38.94788168,-77.44330063462257), radius: 16 };
    gatesMap['A_601'] = { center: new google.maps.LatLng(38.94817539,-77.44336053729057), radius: 16 };
    gatesMap['C_1'] = { center: new google.maps.LatLng(38.94590355,-77.44086474180222), radius: 36 };
    gatesMap['C_3'] = { center: new google.maps.LatLng(38.94593172,-77.44167432188988), radius: 36 };
    gatesMap['C_5'] = { center: new google.maps.LatLng(38.94591361,-77.44239181280136), radius: 36 };
    gatesMap['C_7'] = { center: new google.maps.LatLng(38.94594412,-77.44317457079887), radius: 36 };
    gatesMap['C_9'] = { center: new google.maps.LatLng(38.94585092,-77.44378119707108), radius: 23 };
    gatesMap['C_11'] = { center: new google.maps.LatLng(38.94580834,-77.44425728917122), radius: 23 };
    gatesMap['C_17'] = { center: new google.maps.LatLng(38.94580398,-77.44527518749237), radius: 23 };
    gatesMap['C_19'] = { center: new google.maps.LatLng(38.94584253,-77.44577899575233), radius: 23 };
    gatesMap['C_23'] = { center: new google.maps.LatLng(38.94585226,-77.44642898440361), radius: 23 };
    gatesMap['C_27'] = { center: new google.maps.LatLng(38.94592568,-77.4470767378807), radius: 36 };
    gatesMap['D_1'] = { center: new google.maps.LatLng(38.94592065,-77.4479328095913), radius: 23 };
    gatesMap['D_3'] = { center: new google.maps.LatLng(38.94593138,-77.44866773486137), radius: 36 };
    gatesMap['D_5'] = { center: new google.maps.LatLng(38.94593842,-77.4495193362236), radius: 36 };
    gatesMap['D_7'] = { center: new google.maps.LatLng(38.94592937,-77.45029628276825), radius: 36 };
    gatesMap['D_11'] = { center: new google.maps.LatLng(38.94598804,-77.45102316141129), radius: 23 };
    gatesMap['D_15'] = { center: new google.maps.LatLng(38.94590121,-77.45207324624062), radius: 23 };
    gatesMap['D_19'] = { center: new google.maps.LatLng(38.94593172,-77.45273217558861), radius: 23 };
    gatesMap['D_21'] = { center: new google.maps.LatLng(38.94593775,-77.45338216423988), radius: 36 };
    gatesMap['D_25'] = { center: new google.maps.LatLng(38.94595921,-77.45415061712265), radius: 36 };
    gatesMap['D_29'] = { center: new google.maps.LatLng(38.94594379,-77.45484799146652), radius: 26 };
    gatesMap['D_32'] = { center: new google.maps.LatLng(38.94515187,-77.45477735996246), radius: 36 };
    gatesMap['D_30'] = { center: new google.maps.LatLng(38.9449916,-77.45411574840546), radius: 36 };
    gatesMap['D_26'] = { center: new google.maps.LatLng(38.9450201,-77.45338261127472), radius: 36 };
    gatesMap['D_24'] = { center: new google.maps.LatLng(38.94501407,-77.4527259171009), radius: 23 };
    gatesMap['D_20'] = { center: new google.maps.LatLng(38.94503452,-77.45222613215446), radius: 18 };
    gatesMap['D_18'] = { center: new google.maps.LatLng(38.94500267,-77.45182603597641), radius: 18 };
    gatesMap['D_16'] = { center: new google.maps.LatLng(38.94502681,-77.45139956474304), radius: 18 };
    gatesMap['D_14'] = { center: new google.maps.LatLng(38.9450828,-77.45098069310188), radius: 18 };
    gatesMap['D_12'] = { center: new google.maps.LatLng(38.94506101,-77.45048984885216), radius: 18 };
    gatesMap['D_10'] = { center: new google.maps.LatLng(38.94502111,-77.45006650686264), radius: 23 };
    gatesMap['D_8'] = { center: new google.maps.LatLng(38.94502278,-77.44948580861092), radius: 23 };
    gatesMap['D_6'] = { center: new google.maps.LatLng(38.94504156,-77.44895786046982), radius: 23 };
    gatesMap['D_4'] = { center: new google.maps.LatLng(38.94497585,-77.44847506284714), radius: 23 };
    gatesMap['D_2'] = { center: new google.maps.LatLng(38.94500133,-77.44798824191093), radius: 23 };
    gatesMap['C_30'] = { center: new google.maps.LatLng(38.94493025,-77.44754031300545), radius: 18 };
    gatesMap['C_28'] = { center: new google.maps.LatLng(38.94499596,-77.44712546467781), radius: 18 };
    gatesMap['C_26'] = { center: new google.maps.LatLng(38.94501407,-77.44668871164322), radius: 18 };
    gatesMap['C_24'] = { center: new google.maps.LatLng(38.94494668,-77.44626939296722), radius: 16 };
    gatesMap['C_22'] = { center: new google.maps.LatLng(38.94495372,-77.44594261050224), radius: 16 };
    gatesMap['C_20'] = { center: new google.maps.LatLng(38.94490007,-77.44555950164795), radius: 18 };
    gatesMap['C_18'] = { center: new google.maps.LatLng(38.94493897,-77.44513794779778), radius: 18 };
    gatesMap['C_14'] = { center: new google.maps.LatLng(38.94492522,-77.44441509246826), radius: 18 };
    gatesMap['C_12'] = { center: new google.maps.LatLng(38.94488968,-77.44371324777603), radius: 26 };
    gatesMap['C_8'] = { center: new google.maps.LatLng(38.94481625,-77.44288444519043), radius: 36 };
    gatesMap['C_6'] = { center: new google.maps.LatLng(38.94496579,-77.44221970438957), radius: 26 };
    gatesMap['C_4'] = { center: new google.maps.LatLng(38.94493293,-77.44143024086952), radius: 32 };
    gatesMap['C_2'] = { center: new google.maps.LatLng(38.94492488,-77.44080886244774), radius: 32 };
    gatesMap['Z_9'] = { center: new google.maps.LatLng(38.95153183,-77.44584649801254), radius: 18 };
    gatesMap['Z_8'] = { center: new google.maps.LatLng(38.95155061,-77.44632124900818), radius: 18 };
    gatesMap['Z_7'] = { center: new google.maps.LatLng(38.95152815,-77.44682103395462), radius: 18 };
    gatesMap['Z_6'] = { center: new google.maps.LatLng(38.95154994,-77.44726046919823), radius: 18 };
    gatesMap['R_22'] = { center: new google.maps.LatLng(38.94276571,-77.45225429534912), radius: 41 };
    gatesMap['R_24'] = { center: new google.maps.LatLng(38.94277308,-77.45318368077278), radius: 41 };
    gatesMap['R_26'] = { center: new google.maps.LatLng(38.94278046,-77.45408087968826), radius: 41 };
    gatesMap['R_28'] = { center: new google.maps.LatLng(38.94278783,-77.45498836040497), radius: 41 };
    gatesMap['R_16'] = { center: new google.maps.LatLng(38.94193556,-77.45058819651604), radius: 30 };
    gatesMap['R_14'] = { center: new google.maps.LatLng(38.94243345,-77.44967758655548), radius: 30 };
    gatesMap['R_12'] = { center: new google.maps.LatLng(38.94243445,-77.44895964860916), radius: 30 };
    gatesMap['R_3'] = { center: new google.maps.LatLng(38.9401472,-77.44556352496147), radius: 36 };
    gatesMap['R_5'] = { center: new google.maps.LatLng(38.94014921,-77.44644373655319), radius: 36 };
    gatesMap['R_7'] = { center: new google.maps.LatLng(38.94015122,-77.44732841849327), radius: 36 };
    gatesMap['R_9'] = { center: new google.maps.LatLng(38.9401529,-77.44820415973663), radius: 36 };
    gatesMap['R_11'] = { center: new google.maps.LatLng(38.94015491,-77.44907990098), radius: 36 };
    gatesMap['R_13'] = { center: new google.maps.LatLng(38.94015692,-77.44997084140778), radius: 36 };
    gatesMap['R_15'] = { center: new google.maps.LatLng(38.94016162,-77.45084971189499), radius: 36 };
    gatesMap['R_17'] = { center: new google.maps.LatLng(38.94016363,-77.45172545313835), radius: 36 };
    gatesMap['R_19'] = { center: new google.maps.LatLng(38.94016597,-77.45264500379562), radius: 36 };
    gatesMap['R_29'] = { center: new google.maps.LatLng(38.93694967,-77.45478585362434), radius: 16 };
    gatesMap['R_30'] = { center: new google.maps.LatLng(38.93729467,-77.45478093624115), radius: 16 };
    gatesMap['R_31'] = { center: new google.maps.LatLng(38.93764537,-77.45477601885796), radius: 16 };
    gatesMap['R_32'] = { center: new google.maps.LatLng(38.93798634,-77.45477110147476), radius: 16 };
    gatesMap['R_33'] = { center: new google.maps.LatLng(38.93832229,-77.45476618409157), radius: 16 };
    gatesMap['R_34'] = { center: new google.maps.LatLng(38.93866595,-77.45476126670837), radius: 16 };
    gatesMap['R_35'] = { center: new google.maps.LatLng(38.93900558,-77.45475679636002), radius: 16 };
    gatesMap['R_36'] = { center: new google.maps.LatLng(38.93935293,-77.45475187897682), radius: 16 };
    gatesMap['R_37'] = { center: new google.maps.LatLng(38.93970899,-77.45474651455879), radius: 16 };
    gatesMap['R_38'] = { center: new google.maps.LatLng(38.94006103,-77.4547415971756), radius: 16 };
    gatesMap['R_39'] = { center: new google.maps.LatLng(38.94042011,-77.4547366797924), radius: 16 };
    gatesMap['NW_PARKING_24'] = { center: new google.maps.LatLng(38.9541034,-77.45455741882324), radius: 25 };
    gatesMap['NW_PARKING_25'] = { center: new google.maps.LatLng(38.95347878,-77.45472148060799), radius: 25 };
    gatesMap['NW_PARKING_23'] = { center: new google.maps.LatLng(38.95668805,-77.4544608592987), radius: 35 };
    gatesMap['NW_PARKING_22'] = { center: new google.maps.LatLng(38.95725299,-77.45447427034378), radius: 35 };
    gatesMap['NW_PARKING_21'] = { center: new google.maps.LatLng(38.95778708,-77.45446979999542), radius: 35 };
    gatesMap['NW_PARKING_1'] = { center: new google.maps.LatLng(38.95887941,-77.45413810014725), radius: 35 };
    gatesMap['NW_PARKING_2'] = { center: new google.maps.LatLng(38.95945709,-77.45417833328247), radius: 35 };
    gatesMap['NW_PARKING_3'] = { center: new google.maps.LatLng(38.9599067,-77.45416045188904), radius: 35 };
    gatesMap['N_PARKING_11'] = { center: new google.maps.LatLng(38.96973196,-77.45434060692787), radius: 14 };
    gatesMap['N_PARKING_12'] = { center: new google.maps.LatLng(38.96944866,-77.4543459713459), radius: 14 };
    gatesMap['N_PARKING_13'] = { center: new google.maps.LatLng(38.96916535,-77.45435178279877), radius: 14 };
    gatesMap['N_PARKING_14'] = { center: new google.maps.LatLng(38.96944128,-77.45371699333191), radius: 14 };
    gatesMap['N_PARKING_15'] = { center: new google.maps.LatLng(38.96943491,-77.45309203863144), radius: 14 };
    gatesMap['N_PARKING_16'] = { center: new google.maps.LatLng(38.96916132,-77.45372101664543), radius: 14 };
    gatesMap['N_PARKING_17'] = { center: new google.maps.LatLng(38.96916132,-77.45309248566628), radius: 14 };
    gatesMap['N_PARKING_18'] = { center: new google.maps.LatLng(38.96971989,-77.45308890938759), radius: 14 };
    gatesMap['N_PARKING_19'] = { center: new google.maps.LatLng(38.96972559,-77.45371341705322), radius: 14 };
    gatesMap['NE_PARKING_1'] = { center: new google.maps.LatLng(38.95862393,-77.43888884782791), radius: 18 };
    gatesMap['NE_PARKING_2'] = { center: new google.maps.LatLng(38.95829301,-77.4388875067234), radius: 18 };
    gatesMap['NE_PARKING_3'] = { center: new google.maps.LatLng(38.95793963,-77.4388861656189), radius: 18 };
    gatesMap['NE_PARKING_43'] = { center: new google.maps.LatLng(38.957601,-77.43888482451439), radius: 18 };
    gatesMap['NE_PARKING_5'] = { center: new google.maps.LatLng(38.95688687,-77.44005784392357), radius: 18 };
    gatesMap['NE_PARKING_6'] = { center: new google.maps.LatLng(38.95688586,-77.44050085544586), radius: 18 };
    gatesMap['NE_PARKING_7'] = { center: new google.maps.LatLng(38.95688485,-77.44096755981445), radius: 18 };
    gatesMap['NE_PARKING_8'] = { center: new google.maps.LatLng(38.95688519,-77.44138866662979), radius: 18 };
    gatesMap['NE_PARKING_11'] = { center: new google.maps.LatLng(38.95526815,-77.4410904943943), radius: 14 };
    gatesMap['NE_PARKING_10'] = { center: new google.maps.LatLng(38.9556279,-77.4410904943943), radius: 14 };
    gatesMap['NE_PARKING_9'] = { center: new google.maps.LatLng(38.95599,-77.44109004735947), radius: 14 };
    gatesMap['NE_PARKING_12'] = { center: new google.maps.LatLng(38.95623274,-77.44163900613785), radius: 10 };
    gatesMap['NE_PARKING_13'] = { center: new google.maps.LatLng(38.9559947,-77.44163900613785), radius: 10 };
    gatesMap['NE_PARKING_14'] = { center: new google.maps.LatLng(38.95575598,-77.44163900613785), radius: 10 };
    gatesMap['NE_PARKING_15'] = { center: new google.maps.LatLng(38.95550922,-77.44163900613785), radius: 10 };
    gatesMap['NE_PARKING_16'] = { center: new google.maps.LatLng(38.95527083,-77.44163900613785), radius: 10 };
    gatesMap['NE_PARKING_17'] = { center: new google.maps.LatLng(38.95502508,-77.44163945317268), radius: 10 };
    gatesMap['NE_PARKING_18'] = { center: new google.maps.LatLng(38.95384155,-77.44121924042702), radius: 18 };
    gatesMap['NE_PARKING_19'] = { center: new google.maps.LatLng(38.95313311,-77.44180753827095), radius: 10 };
    gatesMap['NW_PARKING_4'] = { center: new google.maps.LatLng(38.96282226,-77.45416268706322), radius: 20 };
    gatesMap['NW_PARKING_5'] = { center: new google.maps.LatLng(38.96328896,-77.45413184165955), radius: 20 };
    gatesMap['NW_PARKING_6'] = { center: new google.maps.LatLng(38.96375164,-77.45413228869438), radius: 20 };
    gatesMap['NW_PARKING_7'] = { center: new google.maps.LatLng(38.9643709,-77.4541488289833), radius: 26 };
    gatesMap['NW_PARKING_8'] = { center: new google.maps.LatLng(38.96485101,-77.45420560240746), radius: 20 };
    gatesMap['NW_PARKING_9'] = { center: new google.maps.LatLng(38.96525569,-77.45420515537262), radius: 20 };
    gatesMap['NW_PARKING_10'] = { center: new google.maps.LatLng(38.96571569,-77.45420470833778), radius: 20 };
    gatesMap['N_PARKING_1'] = { center: new google.maps.LatLng(38.97081457,-77.4516673386097), radius: 14 };
    gatesMap['N_PARKING_2'] = { center: new google.maps.LatLng(38.97081356,-77.4512292444706), radius: 14 };
    gatesMap['N_PARKING_3'] = { center: new google.maps.LatLng(38.97081256,-77.45081037282944), radius: 14 };
    gatesMap['N_PARKING_4'] = { center: new google.maps.LatLng(38.96974303,-77.4507124722004), radius: 14 };
    gatesMap['N_PARKING_5'] = { center: new google.maps.LatLng(38.9697447,-77.45141968131065), radius: 14 };
    gatesMap['N_PARKING_6'] = { center: new google.maps.LatLng(38.96974538,-77.45201960206032), radius: 14 };
    gatesMap['N_PARKING_8'] = { center: new google.maps.LatLng(38.96829262,-77.45199590921402), radius: 18 };
    gatesMap['N_PARKING_7'] = { center: new google.maps.LatLng(38.96829028,-77.45106652379036), radius: 18 };
    gatesMap['N_PARKING_10'] = { center: new google.maps.LatLng(38.96816723,-77.4542798101902), radius: 18 };

    
 //////END ADDD
 
    ZDCArea = new google.maps.Polygon({
      paths: ZDCCoords,
      strokeColor: "#003300",
      strokeOpacity: 1,
      strokeWeight: .5,
      fillColor: "#666633",
      fillOpacity: .25
    });
                              
    var KIADimageBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(38.92056, -77.4924),  //bottom left
        new google.maps.LatLng(38.9750, -77.4278));  //top right
    
    var KIADCoords = [
      new google.maps.LatLng(38.980,-77.515),
      new google.maps.LatLng(38.900,-77.515),
      new google.maps.LatLng(38.900,-77.420),
      new google.maps.LatLng(38.980,-77.420)   
    ];
    var styles = [
      {
        "stylers": [
          { "visibility": "off" }
         ]
      }
    ];
    var styledMap = new google.maps.StyledMapType(styles, {name: "Styled Map"});
    
    KIADArea = new google.maps.Rectangle({
      strokeColor: "#003300",
      strokeOpacity: 1,
      strokeWeight: 1,
      fillColor: "#666633",
      fillOpacity: .5,
      bounds: KIADimageBounds
    });     

      var historicalOverlay = new google.maps.GroundOverlay(
      'https://vzdc.org/images/NewKIADDiagramTEST.png',
      KIADimageBounds);


     
    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(38.94740, -77.44788),
        disableDefaultUI: true,
        panControl: true,
        zoomControl: true,
        zoom: 16,          //16
        minZoom: 16,       //16
        mapTypeControlOptions: {
          mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
        }
        ///mapTypeId:  'draft' //google.maps.MapTypeId.HYBRID  // 'draft' // 
      });
      map.mapTypes.set('map_style', styledMap);
      map.setMapTypeId('map_style');
      var logoControlDiv = document.createElement('DIV');
      var logoControl = new MyLogoControl(logoControlDiv);
      logoControlDiv.index = 0; // used for ordering
      map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push(logoControlDiv);
      
      copyrightDiv = document.createElement("div")
      copyrightDiv.id = "map-copyright"
      copyrightDiv.style.fontSize = "15px"
      copyrightDiv.style.fontFamily = "Arial, sans-serif"
      copyrightDiv.style.margin = "0 2px 2px 0"
      copyrightDiv.style.color = "red"
      copyrightDiv.style.whiteSpace = "nowrap"
      map.controls[google.maps.ControlPosition.TOP_RIGHT].push(copyrightDiv)
      copyrightDiv.innerHTML = "Loading . . . . "
      
      var infoWindow = new google.maps.InfoWindow;

      //ADD GATES
      /*
      for (var gate in gatesMap) {c
        var eachGate = {
          strokeColor: '#FFFF99',
          strokeOpacity: 0.8,
          strokeWeight: .5,
          fillColor: '#FFFF99',
          fillOpacity: 0.5,
          map: map,
          center: gatesMap[gate].center,
          radius: gatesMap[gate].radius
        };
        //alert (gate);
        // Add the circle for this Gate to the map.
        //gatesCircle = new google.maps.Circle(eachGate);
      } */
      //END ADD GATES
      //ZDCArea.setMap(map);

	historicalOverlay.setMap(map);
        historicalOverlay.setOpacity(.4);

      setInterval(function(){ 

        downloadUrl("iadgates.xml", function(data) {
          var xml = data.responseXML;
          markers = xml.documentElement.getElementsByTagName("marker");
          gatez = xml.documentElement.getElementsByTagName("gate");
          DateMod = xml.documentElement.getElementsByTagName("datemod");
          //alert (DateMod.getAttribute("mod"));
          map.clearOverlays();
          //copyrightDiv.innerHTML = "Last Updated: ";
          //copyrightDiv.innerHTML = DateMod.getAttribute("mod");
          for (var i = 0; i < gatez.length; i++) {
              //var gate =  gatez[i].getAttribute("name");
              //alert(showProps(gatesMap[gate]));
              //gatesMap[gate].setMap(null);
          } 
          
          for (var i = 0; i < markers.length; i++) {
            var name = markers[i].getAttribute("name");
            var dest = markers[i].getAttribute("dest");
            if (name == "DATEMODED") {
               copyrightDiv.innerHTML = "Last Updated: " +dest;
            } else {
              var type = markers[i].getAttribute("type");
              var ACType = markers[i].getAttribute("ACType");
              var flightdata = markers[i].getAttribute("flightdata");
              var HDG = markers[i].getAttribute("HDG");
              var PColor = markers[i].getAttribute("PColor");
              var point = new google.maps.LatLng(
                  parseFloat(markers[i].getAttribute("lat")),
                  parseFloat(markers[i].getAttribute("lng")));
              var html = "<b>" + name + "</b> <br/>" + dest + "<br/>" + flightdata + "<br/>Hdg: " + HDG;
              HDG -= 180;  //for some reason need to orient the plane off 180 deg

              var marker = new google.maps.Marker({
                map: map,
                position: point,
                icon: {
                  anchor: new google.maps.Point(75,75),
                  path: 'M70 115 c0 -18 -9 -31 -30 -43 -16 -9 -30 -21 -30 -25 0 -5 14 -5 31 -2 30 7 31 6 25 -19 -5 -22 -3 -26 14 -26 17 0 19 4 14 26 -6 25 -5 26 25 19 17 -3 31 -3 31 2 0 4 -14 16 -30 25 -21 12 -30 25 -30 43 0 14 -4 25 -10 25 -5 0 -10 -11 -10 -25z',
                  fillOpacity: 1,
                  fillColor: PColor,
                  strokeWeight: 0,
                  scale: 0.1,
                  rotation: HDG
                }
              });


              fLat = parseFloat(markers[i].getAttribute("lat"))+.0002;
              fLon = parseFloat(markers[i].getAttribute("lng"))+.0002;
              var point = new google.maps.LatLng(fLat, fLon);
              FDBInfo = name; // +" " +ACType;
              var FDBLabel = new MapLabel({
                text: FDBInfo,
                position: point,
                map: map,
                fontSize: 11,
                strokeWeight: 0,
                fontColor: '#00FF00',
                align: 'left'
              });

              markersArray.push(marker);
              FDBArray.push(FDBLabel);
              bindInfoWindow(marker, map, infoWindow, html);
            }
          }
          
        })},10000);
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'mouseover', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }
    
    google.maps.Map.prototype.clearOverlays = function() {
      for (var i = 0; i < markersArray.length; i++ ) {     
        markersArray[i].setMap(null);
      }
      for (var j = 0; j < FDBArray.length; j++ ) {     
        FDBArray[j].setMap(null);
      }
    }
    
    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };
      request.open('GET', url, true);

      request.send(null);

    }
    function MyLogoControl(controlDiv) {
        controlDiv.style.padding = '5px';
        var logo = document.createElement('IMG');
        logo.src = 'https://vzdc.org/images/zdccapital.png';
        logo.style.cursor = 'pointer';
        controlDiv.appendChild(logo);
    
        google.maps.event.addDomListener(logo, 'click', function() {
            window.location = 'https://vzdc.org/'; 
        });
    }
    //google.maps.event.addDomListener(window, 'load', initialize);
    function doNothing() {}

    //]]>

  </script>

  </head>

  <body onload="load()">
    <center>
    <font size="6" color="yellow"><b>KIAD Gates In Use</b></font><br>
    <font size="2" color="green">
    This map depicts virtual aircraft connected to the <a href="http://www.vatsim.net/">VATSIM network</a>.    <br>Use the map to see what gates are open prior to connecting your flight simulator to VATSIM.  Enjoy flying out of the vZDC!
    <br></font><font size="3" color="red">The map refreshes automatically approximately every two minutes, but will take about 10 seconds to load the initial data.
    </font><br>
    <div id="map" style="width: 1200px; height: 600px"></div>
    <br>
    <table border=1>
      <tr><td><font color ="green">No Flight Plan:</font></td><td style="background: #A37547;">&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
      <!-- <td>Departures:</td><td style="background: #27c106;">&nbsp;&nbsp;&nbsp;&nbsp;</td> -->
      <tr><td><font color ="green">&nbsp;&nbsp;Parked:</font></td><td style="background: #ff0000;">&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
      <tr><td><font color ="green">&nbsp;&nbsp;Taxiing (Dep):</font></td><td style="background: #FFFF00;">&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
      <tr><td><font color ="green">&nbsp;&nbsp;Taxiing (Arr):</font></td><td style="background: #002af0;">&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
    </table></div>
    <br>
    <font size="2" color="grey">
    The information contained on all pages of this website is to be used for flight simulation purposes only on the VATSIM network. <br>
  It is not intended nor should it be used for real world navigation.  This site is not affiliated with the FAA, the actual Washington Center or any governing aviation body. <br>
  All content contained herein is approved only for use on the VATSIM network.

    </font></center>
	<center><a href="https://www.vzdc.org">Return to ZDC Website</a></center>
  </body>
</html>
