<div class="media borderTop">
    <div class="media-left">
        <img src=" + arrowImg + " class="media-object" style="width:35px">
    </div>
    <div class="media-body">
        <p class="media-heading titlePost">  comment[i]["author"] <span class="dateItem">  le  + date + </span></p>
        
        if (comment[i]["moderate"] == 1) {
        <p>Ce commentaire a été modéré.<p>
        } else {
        <p class="commentContent"> + comment[i]["content"].replace(/\n/g, "<"+"br/>") + '</p>
        }

        <div id="' + comment[i]["id"] + '" name=" comment[i]["parentId"] ">
        
        if (comment[i]["report"] == 1 && comment[i]["moderate"] == 0) {
            <span class="label label-info margRight15">Message signalé </span>
        } else if(session == null) {
            <div>
                <a type="button" class="commentAdd btn btn-xs btnComments" style="margin-right: 5px"> Répondre </a>
                <a type="button" class="btn btn-xs btn-warning" data-confirm="Si vous considérez que ce message est inapproprié, validez pour nous en avertir." data-action="commentReport" data-idItem="' + comment[i]["id"] + '" data-nameId="' + comment[i]["author"] + '" data-titleModal="Signalement du message de"  > Signaler </a>
            </div>
        }

        if (session != null){
            <div class="iconMenu">
            if (comment[i]["moderate"] == 0) {
                <a class="commentAdd text-warning"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Répondre"></span></a>
                <a class="commentModerate text-danger margLeft15" data-toggle="tooltip" title="Modérer"><span class="glyphicon glyphicon-thumbs-down"></span></a>
                if (comment[i]["report"] == 1) {
                <a class="commentUnreport text-success margLeft15" data-toggle="tooltip" title="Accepter"><span class="glyphicon glyphicon-thumbs-up"></span></a>
                }
            }
            <a class="text-danger margLeft15" data-confirm="Suppression du commentaire et des éventuelles commentaires liés (réponse). Validez pour confirmer." data-action="commentDelete" data-idItem="' + comment[i]["id"] + '" data-nameId="' + comment[i]["author"] + '" data-titleModal="Supression du (et des) commentaire(s) de" data-toggle="tooltip" title="Supprimer"><span class="glyphicon glyphicon-remove"></span></a>     
            </div>
        }
        
        </div>
    </div>
</div>  