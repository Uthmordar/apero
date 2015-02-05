(function(ctx){
    "use strict";
    var title, token, tags, $aperosList, $title, $token, $checkbox, $form, $pagination;
    
    var formAjax={
        initialize: function(form){
            $form=form;
            $pagination=$('#pagination');
            $aperosList=$('#aperos_list');
            $title=$('input#title');
            $token=$('input[name=_token]');
            $checkbox=$('input[type="checkbox"]');
            self.bindEvents();
        },
        bindEvents: function(){
            $form.submit(function(e){
                e.preventDefault();
                title=$title.val();
                token=$token.val();
                tags=[];
                for(var i=0; i<$checkbox.length; i++){
                    if($checkbox[i].checked){
                        tags.push($($checkbox[i]).attr('id'));
                    }
                }

                $.ajax({
                    type: "GET",
                    url : "/apero",
                    data : {
                        "title": title,
                        "token": token,
                        "tags": tags
                    },
                    success : function(data){
                        $pagination.remove();
                        if(data.length>0){
                            $aperosList.html('<ul></ul>');
                            for(var i=0; i<data.length; i++){
                                $aperosList.children('ul').append(data[i]);
                            }
                        }else{
                            $aperosList.html('<p>Pas de résultats correspondant à cette recherche.</p>');
                        }
                    },
                    error: function(error){
                        $aperosList.html('<p>Pas de résultats correspondant à cette recherche.</p>');
                    }
                },"json");
                return false;
            });
        }
    };
    
    ctx.formAjax=formAjax;
    var self=formAjax;
})(window);

$("document").ready(function(){
    window.formAjax.initialize($('#form_index'));
});