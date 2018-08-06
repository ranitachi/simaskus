function pesan(txt,jns)
{   
    if(jns=='success')
        toastr.success(txt, "Notifikasi");
    else if(jns=='info')
        toastr.info(txt, "Informasi");
    else if(jns=='error')
        toastr.error(txt, "Peringatan");
}