import dashboard from "../view/pages/Dashboard";

export default function ({next, store}) {
    if (!store.getters.auth.loggedIn || !store.getters.token) {
        return next('login')
    }
    return next()
}
