(()=> {
    document.addEventListener("DOMContentLoaded",() => {
        document.querySelector("#form-registro").addEventListener("submit",async e => {
            e.preventDefault();
            e.pre
            const res = await makeRequest(`api/registro/add.php`,"POST",new FormData(e.target));
            if(res.success){
                e.target.reset();
            }else{
                alert("Ocurrió un error!");
            }
        });
    });
})();