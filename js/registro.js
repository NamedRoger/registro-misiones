(()=> {
    document.addEventListener("DOMContentLoaded",() => {
        const form = (()=>{
            let element = document.getElementById("form-registro");
            return {
                submit: (e) => {
                    e.preventDefault();
                    const data = new FormData(element);
                    const xhr = new XMLHttpRequest();
                    xhr.open(element.getAttribute('method'),element.getAttribute('action'));
                    xhr.onload = () => {
                        if(xhr.status === 200){
                            const response = JSON.parse(xhr.responseText);
                            console.log(response);
                        }
                    }
                    xhr.send(data);
                }
            }
        })();

        document.getElementById("form-registro").addEventListener("submit",form.submit);
    });
})();