class AppStorage {
    storeToken(token) {
        localStorage.setItem("token", token);
    }

    storeUser(user) {
        localStorage.setItem("user", user);
    }

    store(user, token) {
        localStorage.setItem("token", token);
        localStorage.setItem("user", user);
    }

    clear() {
        localStorage.removeItem("token");
        localStorage.removeItem("user");
    }

    getToken() {
        return localStorage.getItem("token");
    }

    getUser() {
        return localStorage.getItem("user");
    }
}

export default AppStorage = new AppStorage();
