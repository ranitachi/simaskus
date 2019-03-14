function pesan(txt,jns)
{   
    if(jns=='success')
        toastr.success(txt, "Notifikasi");
    else if(jns=='info')
        toastr.info(txt, "Informasi");
    else if(jns=='error')
        toastr.error(txt, "Peringatan");
}

function updateizindosen(durl)
{
    setInterval(function(){

        $.ajax({
            url: durl+'/izindosen',
            success:function(res){

            }
        });

    },(1000 * 60 * 60));
}
function updatemulaikp(durl)
{
    setInterval(function(){

        $.ajax({
            url: durl+'/updatemulaikp',
            success:function(res){

            }
        });

    },(1000 * 60 * 60));
}