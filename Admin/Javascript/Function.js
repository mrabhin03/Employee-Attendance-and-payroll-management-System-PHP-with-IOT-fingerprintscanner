
function checkvalid()
{
    a=[]
    b=[]
    value1=document.getElementById('user');
    value2=document.getElementById('pass');
    value3=document.getElementById('name');
    value4=document.getElementById('email');
    value5=document.getElementById('address');
    value6=document.getElementById('dob');
    value7=document.getElementById('mobile');
    value8=document.getElementById('gender');
    b.push(value1,value2,value3,value4,value5,value6,value7,value8,)
    a.push(value1.value,value2.value,value3.value,value4.value,value5.value,value6.value,value7.value,value8.value)
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