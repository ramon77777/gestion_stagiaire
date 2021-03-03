$(function(){
    
    //affichage de l'ancien mot de passe lorsqu'on survoille l'icône (l'oeil)  avec la souris
    
    var txtoldpwd = $('.oldpwd');//cette variable va récupérer l'ancien mot de passe lorsqu'il sera saisit
    
    $('.show-old-pass').hover(//ceci veut dire si on survoille l'icône (l'oeil) on exécute la fonction
    
        function(){
            txtoldpwd.attr('type','text');//ceci veut dire, lors du passage de la souris sur l'icône, on attribut 'text' comme 'type' à la zone de texte de l'élément textoldpwd
        },
        
        function(){//cette fonction va s'exécuter lorsque la souris sera lion de l'icône
            txtoldpwd.attr('type','password');//ceci veut dire, lorsque  la souris est loin de l'icône, on attribut 'password' comme 'type' à la zone de texte de l'élément textoldpwd
        }
    )
    
    
    //affichage du nouveau mot de passe lorsqu'on survoille l'icône (l'oeil)  avec la souris
    
    var txtnewpwd = $('.newpwd');//cette variable va récupérer l'ancien mot de passe lorsqu'il sera saisit
    
    $('.show-new-pass').hover(//ceci veut dire si on survoille l'icône (l'oeil) on exécute la fonction
    
        function(){
             txtnewpwd.attr('type','text');//ceci veut dire, lors du passage de la souris sur l'icône, on attribut 'text' comme 'type' à la zone de texte de l'élément textoldpwd
        },
        
        function(){//cette fonction va s'exécuter lorsque la souris sera lion de l'icône
             txtnewpwd.attr('type','password');//ceci veut dire, lorsque  la souris est loin de l'icône, on attribut 'password' comme 'type' à la zone de texte de l'élément textoldpwd
        }
    )
    

});