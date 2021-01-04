import Token from "./Token";
import AppStorage from "./AppStorage";

class User {
    Login(formData) {
        axios
            .post(`/api/auth/login`, formData)
            .then(res => {
                this.responseAfterLogin(res);
            })
            .catch(err => {
                console.log(err);
            });
    }

    //store in localstorage after login
    responseAfterLogin(res) {
        const access_token = res.data.access_token;
        const username = res.data.user;

        if (Token.isValid(access_token)) {
            AppStorage.store(username, access_token);
            window.location.href = "/forum";
        }
    }

    //some other functions

    hasToken() {
        const storedToken = AppStorage.getToken();
        if (storedToken) {
            return Token.isValid(storedToken) ? true : this.logOut();
        }

        return false;
    }

    loggedIn() {
        return this.hasToken();
    }

    logOut() {
        AppStorage.clear();
        window.location.href = "/forum";
    }

    name() {
        return AppStorage.getUser();
    }

    id() {
        if (this.loggedIn()) {
            const payload = Token.getPayload(AppStorage.getToken());
            return payload.sub; //gives user_id
        }
    }

    amIOwner(user_id) {
        return this.id() == user_id;
    }

    bodyHelper(body) {
        return md.parse(body);
    }
}

export default User = new User();
