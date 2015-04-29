function popUp(article){
		 width = 600;
		 height = 450;
		 if(window.innerWidth)
		 {
				 var left = (window.innerWidth-width)/2;
				 var top = (window.innerHeight-height)/2;
		 }
		 else
		 {
				 var left = (document.body.clientWidth-width)/2;
				 var top = (document.body.clientHeight-height)/2;
		 }
		 window.open('./ecrireComment.php?idArticle='+article,'Commentaire','menubar=no, scrollbars=no, top='+top+', left='+left+', width='+width+', height='+height+'');
 };
 
 function commentaire(article){
		 width = 600;
		 height = 450;
		 if(window.innerWidth){
				 var left = (window.innerWidth-width)/2;
				 var top = (window.innerHeight-height)/2;
		 }
		else{
			 var left = (document.body.clientWidth-width)/2;
				 var top = (document.body.clientHeight-height)/2;
		 }
		 window.open('./readComment.php?idArticle='+article,'Commentaire','menubar=no, scrollbars=no, top='+top+', left='+left+', width='+width+', height='+height+'');
 };
 
 
 
function refresh(){
	opener.location.href=('../main/accueil.php'); 
	setTimeout("self.close();", 1000);  
 }
