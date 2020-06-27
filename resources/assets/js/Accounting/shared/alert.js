import swal from 'sweetalert';

export default function alerts({options, callback = false}) {
    if (callback === true) {
        return new Promise((resolve, reject) => {
            swal(options)
                .then((status) => {
                    if (status) {
                        resolve();
                    } else {
                        reject()
                    }
                });
        });
    } else {
        swal(options);
    }
}