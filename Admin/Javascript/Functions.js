
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