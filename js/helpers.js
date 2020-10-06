
const ajax = ({ url, data, method = 'GET' }) => {

    if( method === 'GET' ) {
        return $.ajax({
            url,
            type: method,
            data,
        });
    } else {
        return $.ajax({
            url,
            type: method,
            dataType: "json",
            data,
        });
    }
}