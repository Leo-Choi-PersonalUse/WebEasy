import VueCookies from 'vue-cookies'
export const cookies = VueCookies.hasOwnProperty('VueCookies') ? VueCookies.VueCookies : VueCookies;

export async function fetchEasy(endPoint, method, body) {
    const setting = {
        method: method,
        body: JSON.stringify(body),
        headers: {
            'Content-Type': 'application/json',
        }
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


