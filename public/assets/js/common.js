function toaster(head, msg, type)
{

    if(type === "success")
    {
        iziToast.success({
            title: head,
            message: msg,
            position: 'topRight'
        });
    }
    else if(type === "error")
    {
        iziToast.error({
            title: head,
            message: msg,
            position: 'topRight'
        });
    }
    else
    {
        iziToast.warning({
            title: head,
            message: msg,
            position: 'topRight'
        });
    }
    
}


            