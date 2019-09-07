
var question = 0;
//add_question();

function addQuestion()
{
	question++;
	var section = document.createElement('section');
	section.setAttribute('id','section'+question);
	section.style.border = "2px solid #ffc107a1";
	section.style.margin = "20px 350px 20px 350px";

	var form1 = document.createElement('form');
	form1.setAttribute('id','form1'+question);
	form1.setAttribute('action','change.input.php');
	form1.setAttribute('method','POST');
	form1.style.margin = "20px";
    
	var ques = document.createElement('input');
	ques.setAttribute('type','text');
	ques.setAttribute('id','question'+question);
	ques.setAttribute('name','question'+question);
	ques.setAttribute('size','50');
	ques.setAttribute('required','required');

	var breakline1 = document.createElement('br');
	var breakline2 = document.createElement('br');

	var main_form = document.getElementById('main_form');
	main_form.appendChild(section);
	section.appendChild(form1);

	var select = document.getElementById('answerType1');
	var clone = select.cloneNode(true);
    clone.id = 'answerType' + (question);
    clone.style.display = '';
    select.parentNode.appendChild(clone);

    section.appendChild(ques);
    section.appendChild(breakline1);
    section.appendChild(breakline2);

}

function addField()
{
	/*var input = document.createElement('input');
	input.setAttribute('type','text');
	input.setAttribute('id','text1');*/



	/*var dropdown = document.createElement('select');
	dropdown.setAttribute('name','answerType');
	dropdown.setAttribute('onchange','this.form.submit()');
    dropdown.innerHTML = "<script>callthis();</script>"*/
    var i = 0;
	//var section = document.getElementById('main');
	//section.appendChild(input);
	var dropdown = document.getElementById('fields' + i);
	var clone = dropdown.cloneNode(true);
    clone.id = 'fields' + (++i);
    dropdown.parentNode.appendChild(clone);
	
}
var i=0;

function add_next_choice()
{
	
	i++;
	var breakline1 = document.createElement('br');
	var breakline2 = document.createElement('br');
	var input = document.createElement('input');
	input.setAttribute('type','text');
	input.setAttribute('id','rb'+i);
	input.setAttribute('placeholder','Option'+ i);
	input.setAttribute('required','required');
	input.setAttribute('name' ,'rb'+i )

	var section = document.getElementById('formElement');
	//var done = document.getElementById('done');
	//alert(elem.parentNode.innerHTML);
    section.appendChild(input);
    section.appendChild(breakline1);
    section.appendChild(breakline2);

    else if(value == 6)
		{
			var input = document.createElement('input');
			input.setAttribute('type','file');
			input.setAttribute('id','input'+number);
			
			section = document.getElementById('section'+number);
			section.appendChild(input);
		}

 }