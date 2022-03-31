function namosw_init_clock()
{
 //*************************************Expliquation sur le fonctionnement du script***********************************
//Ce programme permet de créer une horloge en temps réel
//On peut définir autant d'horloge que l'on souhaite (sur une même page) chaqu'une d'entre elle doit être definie par 2 paramètres le premier
//permet de définir l'id de la balise span dans laquelle l'horloge apparaitra et le second paramètre permet de definir
//le type d'horloge à utiliser
//7 types d'horloge peuvent être affichées
//********************************************************************************************************************
//Cette fonction permet de charger les paramètres qui définissent les différentes horloges (localisation et type de l'horloge)
//ainsi que le contenu des tableaux contenant les noms des jours et des mois lors du chargement de la page

   var type, i, top, obj, clocks, strobj, tempvar;
   clocks = new Array();
     //Permet de récupérer les n argument définits dans les paramètres de la fonction namosw_init_clock() lors du chargement de la page
   for (i = 0, top = 0; i < namosw_init_clock.arguments.length; i += 2)//ici on extrait chaque paramètre définit dans la fonction namosw_init_clock() lors du chargement de la page et on les places dans un tableau objet
        {
        //namosw_init_clock.arguments[i] : paramètre i définit dans les arguments de la fonction namosw_init_clock(argument1, argument2,...)
       strobj = eval('document.getElementById("' + namosw_init_clock.arguments[i] + '")');//Permet de définir l'objet dans lequel sera afficher l'horloge sur la page html à partir des paramètres paires définit dans la fonction lors du chargement de la page
       type = namosw_init_clock.arguments[i+1];
       if (type < 1 && 7 < type) continue;
       clocks[top++] = strobj;
       clocks[top++] = type;
         }
     //*****************definition des tableau contenant les noms des mois et des jours****************
     clocks.months = new Array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet',
                               'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
     clocks.days = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi',
                               'Jeudi', 'Vendredi', 'Samedi');
     //************************************************************************************************
     if (top > 0)
         {
       document.namosw_clocks = clocks;
       namosw_clock();
         }
   }

   function namosw_clock()
   {
   //fonction permettant l'affichage des différentes horloges suivant les différents formats ainsi que les différents endroits
   //(au niveau des balises span) ainsi que le lancement de l'execution toutes les secondes
     var i, type, clocks, next_call, str, hour, ampm, now, year2, year4;
     clocks = document.namosw_clocks;
     if (clocks == null) return;
     next_call = false;
     //affichage de toutes les horloges en fonction du type et de l'id de la balise span dans laquelle l'horloge sera affiché
       for (i = 0; i < clocks.length; i += 2) {
       obj = clocks[i];//objet dans lequel sera affiché la n ième horloge
       type = clocks[i+1];//type d'affichage de la n ième horloge
       now = new Date();
       year2 = now.getYear();
       year4 = year2;
       if (year2 < 1000) year4 = 1900 + year2;
       if (year2 >= 100) year2 = year4;
       //définition des formats en fonction du type 1,2,3,4...
       //remarque : document.getElementById("type1").innerHTML permet d'afficher la date ou l'heure au niveau de la balise span ayant comme id type1
       if (type == 1 || type == 2)
           {
             obj.innerHTML = now.getDate() + ' ' + clocks.months[now.getMonth()] + ' ' + year4;
             if (type == 2)
               obj.innerHTML = clocks.days[now.getDay()] + ' ' + obj.innerHTML;
           }
       else if (type == 3 || type == 4)
           {
             obj.innerHTML = year2 + '/' + (now.getMonth()+1) + '/' + now.getDate();
           }
       else if (type == 5 || type == 6)
           {
             obj.innerHTML = now.getDate() + '/' + (now.getMonth()+1) + '/' + year2;
           }

      if (type == 4 || type == 6 || type == 7)
           {
             hour = now.getHours();
            ampm = 0;
            //Dans cette ligne on teste aussi si les minutes et(ou) les secondes sont <10 si c'est le cas on concatène un 0 devant
             //l'heure et(ou) les secondes (on pourrait faire la même chose avec les heures
             str = hour +':'+ ((now.getMinutes() < 10) ? '0'+now.getMinutes():now.getMinutes()) +':'+ ((now.getSeconds() < 10) ? '0'+now.getSeconds():now.getSeconds());
            if (type == 7)
                 {
                obj.innerHTML = str;
                 }
             else
                 {
                 obj.innerHTML += ' ' + str;
                 }
           }
       //si on utilise l'affichage de l'heure on met la variable next_call a true afin d'executer (settimeout) la fonction namosw_clock()
       //toutes les secondes (1000 millisecondes) pour obtenir l'affichage des secondes en temps réel
       if (type == 4 || type == 6 || type == 7)
          next_call = true;
    }//fin for
     if (next_call)
      window.setTimeout("namosw_clock();", 1000);
  }