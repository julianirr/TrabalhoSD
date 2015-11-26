$(document).ready(function(){
    $('.form-principal').validate({
        rules:{
			uf:{
                required: true
            },
			cpf:{
                required: true,
				//cpf: true,
				minlength: 14				
            },
			nascimento: {
                required: true
            },
			token: {
                required: true,
				minlength: 20
            }
		},
        messages:{
			uf:{
                required: "O campo estado emissor é obrigatório."
            },
            cpf:{
                required: "O campo CPF é obrigatório.",
				// cpf: "Digite um CPF válido.",
				minlength: "O CPF deve conter no mínimo 11 caracteres."
				
            },           
			nascimento: {
                required: "O campo data de nascimento é obrigatório."
            },
			token:{
                required: "O campo token é obrigatório.",
				minlength: "O TOKEN deve conter no mínimo 20 caracteres."
            }
		}
    });
	$('.data').mask('00/00/0000');
	$('.cpf').mask('000.000.000-00');
});