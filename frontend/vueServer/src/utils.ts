import VueCookies from 'vue-cookies'
import Vue3Datatable from '@bhplugin/vue3-datatable';
import { apiService } from '@/appservice';
export const cookies: any = VueCookies.hasOwnProperty('VueCookies') ? VueCookies.VueCookies : VueCookies;

export async function fetchEasy(endPoint, method, body?) {

    let token = cookies.get('token');
    let headers = new Map();
    headers.set('Content-Type', 'application/json')
    headers.set('Authorization', `Bearer ${token}`)

    const setting: any = {
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
    cookies.remove('token');
}

export function getSelectedRows(datatable) {
    debugger;
    const selected = datatable.getSelectedRows();
    selected.forEach((e) => {
        console.log(e);
    })
    return selected;
};

export async function deleteSelectedRows({ tableName, id_list }: { tableName: string, id_list: Array<number> }) {//function from Vue3Datatable
    let ids_str = id_list.join(",");
    let res = await apiService().restfulAPI({ endpoint: tableName, method: "DELETE", query: `id=${ids_str}` })
    return res;
}