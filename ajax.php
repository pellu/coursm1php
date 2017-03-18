<a href="javascript:addColor('bleue');">Lien pour sélectionner la couleur bleue</a><br>
      <a href="javascript:addColor('rouge');">Lien pour sélectionner la couleur rouge</a>
      <BR><BR>
      <DIV id="bleue" style="width:100px;height:100px;background-color:blue;display:none;"></DIV>
      <DIV id="rouge" style="width:100px;height:100px;background-color:red;display:none;"></DIV>

      <SCRIPT type="text/javascript">
         color_array = new Array();
         var ancres_list = window.location.href.split('#');
         var couleurs_list = ancres_list[1].split(':');
         var couleurs_array = couleurs_list[1].split(',');
         for (var couleur in couleurs_array) {
            // affiche les couleurs passées en ancre
            document.getElementById(couleurs_array[couleur]).style.display="block";
            color_array[couleurs_array[couleur]] = 1;
         }
         
         function addColor(color) {
            var color_line = '';
            if (color_array[color]) {
               // enlever la couleur
               color_array[color] = 0;
               document.getElementById(color).style.display="none";
            } else {
               // ajouter la couleur
               color_array[color] = 1;
               document.getElementById(color).style.display="block";
            }
            
            for (var color in color_array) {
               if (color_array[color]) {
                  color_line += color+',';
               }
            }
            // recréé l'URL avec les ancres de couleurs
            color_line = color_line.substring(0,(color_line.length-1));
            if (color_line != '') {
               color_line = "#couleur:"+color_line;
            } else {
               color_line = "#";
            }
            window.location.href=color_line;
         }
      </SCRIPT>