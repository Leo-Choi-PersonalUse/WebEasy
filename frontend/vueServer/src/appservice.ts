import { cookies } from '@/utils';

export const apiService = () => {
    const url = "http://localhost/backend/api";
    const restfulAPI = async ({ endpoint, method, body, query }: { endpoint: string, method: string, body?: object, query?: string }) => {

        query = query != null ? `?${query}` : "";
        try {
            const response = await fetch(`${url}/v1/${endpoint}${query}`, {
                method: method,
                headers: {
                    'Authorization': `Bearer ${cookies.get("token")}`,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(body)
            })
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('There has been a problem with your fetch operation:', error);
            return null;
        }
    };

    const loginAPI = async ({ endpoint, body }: { endpoint: string, body: object }) => {
        try {
            const response = await fetch(`${url}/auth/${endpoint}`, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(body)
            })
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            return data;
        }
        catch (error) {
            console.error('There has been a problem with your fetch operation:', error);
            return null;
        }
    }

    //callable function
    return {
        restfulAPI,
        loginAPI,
    };
};