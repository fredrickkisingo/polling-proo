export const setCurrentPageTitle = ({ commit }, currentPageTitle) => {
    commit('SET_CURRENT_PAGE_TITLE', currentPageTitle);
};

export const setErr = ({ commit }, error) => {
    commit('ERR', error);
};

export const setSuccessMessage = ({ commit }, successMessage) => {
    commit('SET_SUCCESS_MESSAGE', successMessage);
};

export const setUserPermissions = ({ commit }, userPermissions) => {
    commit('SET_USER_PERMISSIONS', userPermissions);
};
