
function checkvalid()
{
    a=[]
    b=[]
    value1=document.getElementById('user');
    value3=document.getElementById('name');
    value4=document.getElementById('email');
    value5=document.getElementById('address');
    value6=document.getElementById('dob');
    value7=document.getElementById('mobile');
    value8=document.getElementById('gender');
    b.push(value1,value3,value4,value5,value6,value7,value8,)
    a.push(value1.value,value3.value,value4.value,value5.value,value6.value,value7.value,value8.value)
    co=0
    for(i=0;i<7;i++)
    {
        if(a[i]=='')
        {
            co=1
            b[i].style.borderColor='red';
        }
        else
        {
            b[i].style.borderColor='#d2d6de';
        }
    }
    if(co==1)
    {
    }
    else
    {
        add_new_page()
    }
}
function add_new_page()
{
    const addempdata = document.querySelector('.addempin'); 
    if (addempdata.classList.contains('active')) {
        addempdata.classList.remove('active');
      } else {
        addempdata.classList.add('active');
      }
}
function checktofromfirst()
{
    oldto=document.getElementById('oldto');
    newfrom=document.getElementById('newfrom');
    var yeartemp = oldto.value.substr(0, 4);
    var monthtemp= oldto.value.substr(5);
    var month = (parseInt(monthtemp, 10)+1);
    var year  = (parseInt(yeartemp, 10));
    if(month>12)
    {
        month=1;
        year=year+1;
    }
    month=month.toString().padStart(2, '0');
    newfrom.value=year+"-"+month;
}
checkvalue=0;
function checktofromsec()
{
    newfrom1=document.getElementById('newfrom');
    newto1=document.getElementById('newto');
    invalid=document.getElementById('not_valid');
    if(newfrom1.value>=newto1.value)
    {
        newto1.style.borderColor = 'red';
        invalid.textContent="Invalid Designation Date";
        checkvalue=0;
    }
    else
    {
        newto1.style.borderColor = '#d2d6de';
        invalid.textContent="";
        checkvalue=1;
    }
}
function thesubmitfun()
{
    if(checkvalue==0)
    {
        checktofromsec();
        return false;
    }
    else
    {
        return true;
    }
}
function checkdataEMAIL() {
    var numberlebal = document.getElementById('notnumber');
    mobnumberbox = document.getElementById('mobile');
    emailbox = document.getElementById('email');
    var mobnumber = mobnumberbox.value;
    var email =emailbox.value;
    var emaillebal = document.getElementById('notemail');
    numberlebal.textContent="";
    emaillebal.textContent="";
    i=0;
    j=0;
    var data = new FormData();
    if(mobnumber!='')
    {
        if(!isNaN(mobnumber) && !isNaN(parseFloat(mobnumber)))
        {
            if(mobnumber.length === 10)
            {
                data.append('Mobile', mobnumber);
                mobnumberbox.style.borderColor='#d2d6de';
            }
            else
            {
                mobnumberbox.style.borderColor='red';
                numberlebal.textContent="Mobile number must be 10 digits";
            }
        }
        else
        {
            mobnumberbox.style.borderColor='red';
            numberlebal.textContent="Enter a valid Mobile number ";
        }
    }
    else
    {
        mobnumberbox.style.borderColor='red';
        numberlebal.textContent="Mobile number can't be empty";
    }
    if(email!='')
    {
        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if(emailPattern.test(email))
        {
            data.append('Email', email);
            emailbox.style.borderColor='#d2d6de';
        }
        else
        {
            emailbox.style.borderColor='red';
            emaillebal.textContent="Enter a valid Email";
        }
    }
    else
    {
        emailbox.style.borderColor='red';
        emaillebal.textContent="Email can't be empty";
    }
    var xhr = new XMLHttpRequest();
    var url = "Edit_code/email_phone_check.php";

    xhr.open("POST", url, true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Check the response from PHP
            var response = xhr.responseText.split(',');
            var emaildata = parseInt(response[0]);
            var mobiledata = parseInt(response[1]);

            if (emaildata != 404) {
                if(emaildata==0)
                {
                    emailbox.style.borderColor='green';
                    i=1;
                }
                else
                {
                    emaillebal.textContent="Email already exists";
                }
            } else {
                return 0;
            }

            if (mobiledata != 404) {
                if(mobiledata==0)
                {
                    mobnumberbox.style.borderColor='green';
                    j=1;
                }
                else
                {
                    numberlebal.textContent="Mobile number already exists";
                }
            } else {
                return 0;
            }
            if(i==1&&j==1)
            {
                checkvalid();
            }
            else
            {
                return 0;
            }
        }
    };
    xhr.send(data);
}
