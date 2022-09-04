<link rel="stylesheet" href="CSSs/Style.css">
<link rel="stylesheet" href="CSSs/login.css">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(() => {
            let isSectionPrivate=false;

            $("#submit").click(() => {
                console.log("clicked");
                let link = $("#link").val();
                let groupCourseCode = $("#id").val();
                let groupSection = $("#number").val();
                let isAllFilled=true;
                let isFilledRight=true;
                if(link === ""){

                    $("#link").css("border-bottom", "1px solid red")
                    isAllFilled = false;
                    isFilledRight = false;
                }else{
                    $("#link").css("border-bottom", "1px solid #fff")

                    if(link.length<26 || link.substring(0,26) !== "https://chat.whatsapp.com/"){
                        $("#linkfeedbackDiv").text("رابط القروب غير صحيح.");
                        $("#link").css("border-bottom", "1px solid red");
                        isFilledRight = false;
                    }else{
                        $("#linkfeedbackDiv").text("")
                    }
                }
                if(groupCourseCode === ""){
                    $("#id").css("border-bottom", "1px solid red")
                    isAllFilled = false;
                    isFilledRight = false;

                }else
                    $("#id").css("border-bottom", "1px solid #fff")

                if(groupSection === ""){
                    if(isSectionPrivate) {
                        $("#number").css("border-bottom", "1px solid red")
                        isAllFilled = false;
                        isFilledRight = false;
                    }
                }else{
                    if(!isSectionPrivate)
                        $("#number").val("");

                    $("#number").css("border-bottom", "1px solid #fff")
                }

                if(!isAllFilled){
                    $("#feedbackDiv").css("color","red")
                    $("#feedbackDiv").text("يجب تعبئة جميع الحقول.")
                }else {
                    $("#feedbackDiv").text("")

                }

                if(!isFilledRight)
                    return;

                if(!isSectionPrivate)
                    groupSection ='عام';
                var newGroup = {
                    link: $("#link").val(),
                    groupCourseCode: $("#id").val(),
                    groupSection: groupSection
                };

                $.ajax({
                    type:'POST',
                    url:'http://localhost:3000/api/addWGroup',
                    data: JSON.stringify(newGroup),
                    contentType:'application/json',
                    beforeSend: () =>{
                        $("#spinner").css("height","50px");
                        $("#spinner").css("visibility","visible");

                    },
                    success: (group)=>{
                        $("#spinner").css("height","0px");
                        $("#spinner").css("visibility","hidden");
                        $("#feedbackDiv").css("color","green")
                        $("#feedbackDiv").text("تمت اضافة القروب !")
                    },
                    error: (err)=> {
                        $("#spinner").css("height","0px");
                        $("#spinner").css("visibility","hidden");
                        $("#feedbackDiv").css("color","red")
                        $("#feedbackDiv").text("نعتذر قد حدثت مشكلة.")
                        //هنا لما الرابط يطلع غلط او اي غلط ممكن يجي في ال api
                    } //to do!!!
                });
            })


            $("#contractToggle").change(()=>{
                if($("#contractToggle").is(':checked')){
                    $("#sectionNumberDiv").css("visibility","visible");
                    $("#sectionNumberDiv").css("height","unset");
                    isSectionPrivate = true;


                }else {
                    $("#sectionNumberDiv").css("visibility","hidden");
                    $("#sectionNumberDiv").css("height","0");
                    isSectionPrivate=false;
                    $("#number").css("border-bottom", "1px solid #fff")
                    $("#feedbackDiv").text("")
                }
            })
        })

    </script>
</head>
<body>
<div class="login-box " style=" transform: none;position: absolute;
background-color: #161616;  ; top: 10%; left:35%;  height: auto; width: 30% ">

    <div class="user-box">
        <input type="text" name="course_id" id="id" required="" maxlength="7">
        <label> رمز المادة </label>
    </div>



    <div class="user-box">
        <input type="text" name="courselink" id="link" required="" maxlength="50">
        <label> رابط القروب </label>
    </div>
    <div class="user-box" id="sectionNumberDiv" style="visibility: hidden; height: 0px">
        <input type="text" name="course_number" id="number" required="" maxlength="5">
        <label > رقم الشعبة </label>
    </div>
    <div style="text-align: center; direction: rtl;">
    <label for="contractToggle" class="contract_toggle" style="font-size: 16px; color: #fff;">
        قروب خاص لشعبة ؟
        <input type="checkbox" id="contractToggle" name="contract_toggle"/>
        <span class="toggle_bar">
    <span class="toggle_square"></span>
  </span>
    </label>
    </div>


    <div style="text-align: center; color: red; direction: rtl" id="feedbackDiv"></div>
        <div style="text-align: center; color: red; direction: rtl" id="linkfeedbackDiv"></div>
        <div class="lds-ring" id="spinner" style="visibility: hidden; height: 0px"><div></div><div></div><div></div><div></div></div>

    <button type="submit" name="add" id="submit" class="agreebutton" >

        اضافة
    </button>

        <a style="position: absolute; right:35px; " href="index.php" id="cancelButton">

            الغاء
        </a>
</div>
</body>