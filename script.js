/*$( document ).ready(function() {
    $('.increment-btn').click(function (e) { 
        e.preventDefault();
        var qty=$(this).closest('.cart_btns').find('.qty_input').val();
        //var qty=$('.qty_input').val();
        //alert (qty);
        var value =parseInt(qty,10);
        value =isNaN(value)? 0:value; //value-int? if not - value=0
        if(value<10)
        {
            value++;
           $(this).closest('.cart_btns').find('.qty_input').val();
             //$('.qty_input').val(value);
        }
 });

 $('.decrement-btn').click(function (e) { 
    e.preventDefault();
    //var qty=$(this).closest('.cart_btns').find('.qty_input').val();
    var qty=$('.qty_input').val();
    //alert (qty);
    var value =parseInt(qty,10);
    value =isNaN(value)? 0:value; //value-int? if not - value=0
    if(value>1)
    {
        value--;
        //$(this).closest('.cart_btns').find('.qty_input').val();
        $('.qty_input').val(value);
    }
    });
});*/
/*var incrementButton = document.getElementsByClassName('increment');
var decrementButton=document.getElementsByClassName('decrement');
//increment
for(var i =0; i<incrementButton.length;i++){
    var button = incrementButton[i];
    button.addEventListener('click',function(e){
        var buttonClicked = e.target;
        //console.log(buttonClicked);
        var input = buttonClicked.parentElement.children[2];
        var inputValue = input.value;
        var newValue = parseInt(inputValue) + 1;
        input.value = newValue;
    })
}
//decrement
for(var i =0; i<decrementButton.length;i++){
    var button = decrementButton[i];
    button.addEventListener('click',function(e){
        var buttonClicked = e.target;
        var input = buttonClicked.parentElement.children[2];
        var inputValue = input.value;
        var newValue = parseInt(inputValue) - 1;
        if(newValue>=1){
            input.value = newValue;
        }
        else{
            input.value = 1;
        }
    })
}*/
$(function() {
	$('[data-decrease]').click(decrease);
	$('[data-increase]').click(increase);
	$('[data-value]').change(valueChange);
});

function decrease() {
	var value = $(this).parent().find('[data-value]').val();
	if(value > 1) {
		value--;
		$(this).parent().find('[data-value]').val(value);
	}
}

function increase() {
	var value = $(this).parent().find('[data-value]').val();
	if(value < 100) {
		value++;
		$(this).parent().find('[data-value]').val(value);
	}
}

function valueChange() {
	var value = $(this).val();
	if(value == undefined || isNaN(value) == true || value <= 0) {
		$(this).val(1);
	} else if(value >= 101) {
		$(this).val(100);
	}
}
