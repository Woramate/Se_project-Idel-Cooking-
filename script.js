var modal = document.getElementById('loginBox');
var modal2 = document.getElementById('signupBox');
var body = document.getElementById('myBody');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        closeLoginModal();
    }
    if (event.target == modal2){
        closeSignupModal();
    }

}

function showLoginModal(){
    closeSignupModal();
    document.getElementById('loginBox').style.display='block';
    document.getElementById('myBody').style.overflow='hidden';
}
function closeLoginModal(){
    document.getElementById('loginBox').style.display='none';
    document.getElementById('myBody').style.overflow='auto';
}
function showSignupModal(){
    closeLoginModal();
    document.getElementById('signupBox').style.display='block';
    document.getElementById('myBody').style.overflow='hidden';
}
function closeSignupModal(){
    document.getElementById('signupBox').style.display='none';
    document.getElementById('myBody').style.overflow='auto';
}

var acc = document.getElementsByClassName("accordion");
            var i;
for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}

var closebtns = document.getElementsByClassName("close-ul");
var i;
for (i = 0; i < closebtns.length; i++) {
    closebtns[i].addEventListener("click", function () {
        this.parentElement.style.display = 'none';
    });
}

function Display1() {
    document.getElementById('sidebarID').style.overflow = 'hidden';
    document.getElementById('yourIngredient').style.display = 'block';
}
function Display2() {
    document.getElementById('sidebarID').style.overflowY = 'scroll';
    document.getElementById('yourIngredient').style.display = 'none';
}

var inputTag = ["0"];
var pictureStep =["Pic0"];
var pictureBtn = ["Btn0"];
var pictureTag = ["PicTag0"]
$("#PicTag0").change(function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#Pic0').attr('src', e.target.result);
          $('#Pic0').css('display','initial');
        }
        reader.readAsDataURL(this.files[0]);
      }
  });

$("#Btn0").click(function () {
    $("#PicTag0").trigger('click');
});

$('.addMore').click(function(){
    inputTag.push((inputTag.length).toString());
    $tmpInput = $('<textarea class="thisIsHowToDo" name="step_"></textarea>');
    $tmpInput.addClass(inputTag[inputTag.length-1]);
    console.log('PicTag'+((pictureTag.length).toString()));
    pictureTag.push('PicTag'+((pictureTag.length).toString()));
    pictureBtn.push('Btn'+((pictureBtn.length).toString()));
    pictureStep.push('Pic'+((pictureStep.length).toString()));
    $tmpPicture = $('<div class="mainPictureBox">          \
                        <div  class="recipePicture picBorder">\
                            <img id="Pic'+((pictureStep.length-1).toString()) +'" src="#" alt="recipe image" class="picFull" style="display:none"/>\
                        </div>\
                        <div class="addImage">\
                            <img src="picture/addImage2.png" id="Btn'+(pictureBtn.length-1).toString() +'" style="cursor:pointer" />\
                            <input type="file" id="PicTag'+(pictureTag.length-1).toString()+'" name="'+(pictureTag.length-1).toString()+'" style="display:none" value="1" />\
                        </div>\
                    </div>');
    // ------------
    $('.howToDo').on('click',"#"+pictureBtn[pictureBtn.length-1],function(){
        console.log('22222');
        $("#"+pictureTag[pictureBtn.length-1]).trigger('click');
    });

    $('.howToDo').on('change',"#"+pictureTag[pictureTag.length-1],function(){
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#'+pictureStep[pictureStep.length-1]).attr('src', e.target.result);
              $('#'+pictureStep[pictureStep.length-1]).css('display','initial');
            }
            reader.readAsDataURL(this.files[0]);
          }
        else{
            console.log('gg');
        }
    });

    $(".howToDo").append($tmpInput);
    $('.howToDo').append($tmpPicture);
});
$('body').on('click', '[data-editable]', function(){
    $btn = $(this);
    if($btn.text() == "บันทึก"){
        var $el = $('.recipeNameTag');
        var $p = $('<h2/>').text( $el.val() );
        $p.addClass('recipeNameTag');
        $el.replaceWith($p);
        $('.addImage').css('visibility','hidden');
        $('.recipePicture').removeClass('picBorder');
        for(let i=0; i<inputTag.length; i++){
            var myclassName = ".".concat(inputTag[i]);
            var $el = $(myclassName);
            var $p = $('<p/>').text( $el.val() );
            $p.addClass(inputTag[i]);
            $p.addClass('addClass');
            $el.replaceWith( $p );
        }
        $('.addMore').css('visibility','hidden');
        $btn.text("แก้ไข");
    }else{
        var $el = $('.recipeNameTag');
        var $input = $('<input/>').val( $el.text() );
        $input.addClass('recipeNameTag');
        $el.replaceWith($input);
        $('.addImage').css('visibility','initial');
        $('.recipePicture').addClass('picBorder');
        for(let i=0; i<inputTag.length; i++){
            var myclassName = ".".concat(inputTag[i]);
            var $el = $(myclassName);
            var $input = $('<textarea/>').val($el.text());
            $input.addClass(inputTag[i]);
            $input.addClass('step_');
            $el.replaceWith($input);
        }
        $('.addMore').css('visibility','initial');
        $btn.text("บันทึก");
    }

});
// --------------image------------------
$("#getRecipePic").change(function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#mainPic').attr('src', e.target.result);
          $('#mainPic').css('display','initial');
        }
        reader.readAsDataURL(this.files[0]);
      }
  });

$("#addBtnPic").click(function () {
    $("#getRecipePic").trigger('click');
});
// --------end image -------------------
