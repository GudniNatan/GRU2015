Skrálýsing

Hér verður skráuppsetningu (file/folder structure) lýst. Allar skrár verða inni í GRU folder.

- Gagnagrunnur 
- gagnagrunnur.sql - Sql script sem geymir uppsetninguna á gagnagrunninum sem við notum. Töflur í gagnagrunninum verða meðal annars medlimir, viðburdir og admin. Ég held að besta leiðin til að geyma hvaða meðlimir séu skráðir á hvaða viðburði sé að hafa sér töflu fyrir hvern meðlim. 
- Vefsíða 
- index.html.php - Forsíða. Hér mun vera texti sem lýsir aðeins skemmtistaðnum og kannski myndir. Á öllum síðum verður nav efst sem verður að aðlagast mismunandi skjástærðum (responsive web design). Hér verður líka listi yfir atburði sem eru framundan (nota php). Líka muna að hafa takka til að skrá sig inn. Meira um vefsíðu í verkefnalýsingu. 
- skraning.html.php - Hér verður form til að skrá sig á viðburði og það sýnir líka viðburði sem þú ert skráður á. Ef þú ert ekki skráður inn á það að segja þér það eða redirecta beint á login síðu. Formið linkar ekki á neina aðra síðu svo hér þarf að setja php kóðann þannig upp að ef það er ekkert POST data á það ekki að reyna að skrá þig á  viðburð. 
- atburdir.html.php - Hér á að vera hægt að velja tvær dagsetningar (input type="date") og sýna alla viðburði sem gerast á því bili (nota between í select skipun). Aftur linkar formið á sömu síðu svo það verður að vera eitthvað default. 
- login.html - Þessi síða er með tvö form. Bæði til að skrá sig inn og nýskrá sig. Eftir að þú skráir þig inn á medlimur.html.php að koma upp. Eftir að þú nýskráir þig á það að að skrá þig inn eins og venjulega. 
- medlimur.html.php - Hér á að vera hægt að skrá sig á atburði og afskrá sig. 
- dbcon.php - Tengir við gagnagrunn 
- CSS 
- stilsida.css - Stílsíða. Ég vil að við notum less/sass en ef við nennum því ekki er það alveg í fína. Þurfum að gera animations. 
- JS 
- javascript.js - Ef við þurfum javascript. Reynum ekki að nota það allt of mikið. Muna eftir JQuery líka. 
- C# 
- Form1.cs - Hér verður innskráning. Bara admin getur skráð sig inn hér. 
- Form2.cs - Hér verður að geta skoðað allar töflur (best að nota listview) og að geta skráð breytt og eytt fyrir allar töflur. Ég hugsa að það sé best að nota tabcontrol. Einn tab fyrir hverja töflu. Það verður líka að vera hægt að bæta við og eyða öðrum admin-um. 
- Gagnagrunnur.cs - endurnotum gamlann Gagnagrunnur.cs en breytum eftir þörfum. 
  

Allt saman verður að vera í git svo við getum unnið saman auðveldlega.
