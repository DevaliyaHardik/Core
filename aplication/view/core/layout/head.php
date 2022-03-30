<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/style.css">
    <title><?php echo $this->getTitle(); ?></title>
    <script src="skin/admin/js/jquery-3.6.0.min.js"></script>
    <script src="skin/admin/js/admin.js"></script>

    <style>
        body {
            margin: 0;
        }

        .topnav {
            display: table;
            text-align: center;
            width: 100%;

            overflow: hidden;
            background-color: black;
        }

        .topnav a {
            color: #f2f2f2;
            display: inline-block;
            float: none;
            font-size: 25px;
            padding: 10px 30px;
            text-decoration: none;
            font-weight: bold;
        }

        .topnav a:hover {
            color: black;
        }

        #logoutbutton{
            background-color: black;
        }
    </style>
    <script type="text/javascript">
    customer = {
        url : 'index.php',
        form : null,
        setUrl : function(url) {
            this.url = url;
            return this;
        },
        getUrl : function() {
            return this.url;
        },
        setData : function(data) {
            this.data = data;
            return this;
        },
        getData : function() {
            return this.data;
        },
        setForm : function(form) {
            this.form = jQuery('#' + form);
            return this;
        },
        getForm : function() {
            return this.form;
        },
        validate : function(){
            var canSubmit = true;
            // if(!jQuery("#name").val())
            // {
            //     alert('Plz enter name.');
            //     canSubmit = false;
            // }
            // if(!jQuery("#email").val())
            // {
            //     alert('Plz enter email.');
            //     canSubmit = false;
            // }
            // if(!jQuery("#mobile").val())
            // {
            //     alert('Plz enter mobile.');
            //     canSubmit = false;
            // }
            if(canSubmit == true)
            {
                this.callSaveAjax();
            }
            return false;
        },
        callSaveAjax : function(){
            $.ajax({
                url: "<?php echo $this->getUrl('save') ?>",
                type: "POST",
                data: this.getData(),
                success: function(data){
                    $("#done").html(data);
                }
            });
        },
        callDeleteAjax : function(){
            $.ajax({
                url: "<?php echo $this->getUrl('delete') ?>",
                type: "GET",
                data: this.getData(),
                success: function(data){
                    $("#done").html(data);
                }
            });
        }
    };

    function ppc() {
        const ppcValue = document.getElementById('ppc').selectedOptions[0].value;
        let language = window.location.href;
        if(!language.includes('ppc'))
        {
            language+='&ppc=20';
        }
        const myArray = language.split("&");
        for (i = 0; i < myArray.length; i++)
        {
            if(myArray[i].includes('p='))
            {
                myArray[i]='p=1';
            }
            if(myArray[i].includes('ppc='))
            {
                myArray[i]='ppc='+ppcValue;
            }
        }
        const str = myArray.join("&");
        location.replace(str);
    }

    $(document).ready(function(){
        $(".delete").click(function(){
            var data = $(this).val();
            admin.setData({'id' : data});
            admin.callDeleteAjax();
        });
    });

</script>

</head>
