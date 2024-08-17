import VueCookies from 'vue-cookies'
export const cookies = VueCookies.hasOwnProperty('VueCookies') ? VueCookies.VueCookies : VueCookies;

export async function fetchEasy(endPoint, method, body?) {

    let token = utils.cookies.get('token');
    let headers = new Map();
    headers.set('Content-Type', 'application/json')
    headers.set('Authorization', `Bearer ${token}`)
    
    const setting = {
        method: method,
        body: isNOtEmptyNull(body) ? JSON.stringify(body) : JSON.stringify({}),
        headers: headers
    };
    try {
        const response = await fetch(endPoint, setting);
        if (!response.ok)
            throw new Error(`Response status: ${response.status}`);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error(error);
    }
}

export function isEmptyNull(str) {
    return str == null || str.length == 0 || str == '';
}

export function isNOtEmptyNull(str) {
    return !isEmptyNull(str);
}

export async function logout() {
    const api = `/backend/api/auth/logout`;
    const response = await fetchEasy(api, 'POST');
    VueCookies.VueCookies.remove('token');
}

