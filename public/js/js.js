function pesan(txt,jns)
{   
    if(jns=='success')
        toastr.success(txt, "Notifikasi");
    else if(jns=='info')
        toastr.info(txt, "Informasi");
    else if(jns=='error')
        toastr.error(txt, "Peringatan");
}

function updateizindosen()
{
    setInterval(function(){

        $.ajax({
            url: 'izindosen',
            success:function(res){

            }
        });

    },(1000 * 60 * 60));
}