class Token {
    isValid(token) {
        const processed_payload = this.getPayload(token);
        if (processed_payload) {
            return processed_payload.iss ==
                "http://127.0.0.1:8000/api/auth/login" ||
                "http://127.0.0.1:8000/api/auth/signup"
                ? true
                : false;
        }

        return false;
    }

    getPayload(token) {
        const payload = token.split(".")[1];
        if (this.isBase64(payload)) {
            return JSON.parse(atob(payload)); //atob decodes base64
        }
    }

    isBase64(payload) {
        try {
            return btoa(atob(payload)).replace(/=/g, "") == payload;
        } catch {
            return false;
        }
    }
}

export default Token = new Token();
