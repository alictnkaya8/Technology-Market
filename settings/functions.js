$(document).ready(function(){
    $.showAnswer = function(id){
        var processedArea = "#" + id;
        $(".AnswerArea").slideUp();
        $(processedArea).parent().find(".AnswerArea").slideToggle();
    };
    $.changeProductDetailPicture = function(folder, picture){
        var folderPath = "pictures/products/" + folder + "/" + picture;
        $("#bigPicture").attr("src", folderPath);
    };
});