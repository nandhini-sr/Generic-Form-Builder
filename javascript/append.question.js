var question = 0;
var op = 0;
//add_question();

document.getElementById('answerType0').style.display = 'none';

function addQuestion()
{
	question++;
	var section = document.createElement('section');
	section.setAttribute('id','section'+question);
	section.style.border = "2px solid #ffc107a1";
	section.style.margin = "20px 350px 20px 350px";
	section.style.padding = "0px 0px 20px 0px";

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
	ques.setAttribute('placeholder','question'+question);

	var breakline1 = document.createElement('br');
	var breakline2 = document.createElement('br');
	var breakline3 = document.createElement('br');

	var input = document.createElement('input');
	input.setAttribute('type','text');
	input.setAttribute('id','input'+question);
	input.setAttribute('placeholder','short answer preview');

	var button = document.createElement('button');
	button.setAttribute('id','button'+question);
	button.setAttribute('onclick','displayInput(3,"buttton"+question); return false;');
	button.style.display = "none";


	var main_form = document.getElementById('main_form');
	main_form.appendChild(section);
	section.appendChild(form1);
    
    document.getElementById('answerType0').style.display = 'block';
	var select = document.getElementById('answerType0');
	var clone = select.cloneNode(true);
    clone.id = 'answerType' + (question);
    clone.setAttribute('name','answerType' + (question));
    
    section.appendChild(clone);
    section.appendChild(breakline1);
    section.appendChild(ques);
    section.appendChild(breakline2);
    section.appendChild(breakline3);
    section.appendChild(input);
    section.appendChild(button);
    document.getElementById('answerType0').style.display = 'none';

}

function displayInput(value,id)
{
	//alert(id);
		
		var number = id.match(/\d/g);
		number = number.join("");
		//alert(number);
		//var number = id[id.length - 1];
		if(document.getElementById('input'+number))
		{
			document.getElementById('input'+number).remove();
		}
	
		if(value == 1)
		{
			var input = document.createElement('input');
			input.setAttribute('type','text');
			input.setAttribute('id','input'+number);
			input.setAttribute('placeholder','short answer preview');

			section = document.getElementById('section'+number);
			section.appendChild(input);

		}
		else if(value == 2)
		{
			var input = document.createElement('textarea');
			input.setAttribute('rows','5');
			input.setAttribute('cols','30');
			input.setAttribute('id','input'+number);
			input.setAttribute('placeholder','paragraph preview');

			section = document.getElementById('section'+number);
			section.appendChild(input);
		}
        //radio button and check box removed!
        else if(value == 3)
		{
			var input = document.createElement('input');
			input.setAttribute('type','number');
			input.setAttribute('id','input'+number);
			input.setAttribute('placeholder',' number preview');
			
			section = document.getElementById('section'+number);
			section.appendChild(input);
		}
		else if(value == 4)
		{
			var input = document.createElement('input');
			input.setAttribute('type','time');
			input.setAttribute('id','input'+number);
			
			section = document.getElementById('section'+number);
			section.appendChild(input);
		}
		else if(value == 5)
		{
			var input = document.createElement('input');
			input.setAttribute('type','date');
			input.setAttribute('id','input'+number);
			
			section = document.getElementById('section'+number);
			section.appendChild(input);
		}
			
}