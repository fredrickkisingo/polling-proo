export const LOADING_STATUS = (state, newLoadingStatus) => {
    state.loadingStatus = newLoadingStatus;
};

export const ERR = (state, newError) => {
    state.error = newError;
};

export const SET_SUCCESS_MESSAGE = (state, newSuccessMessage) => {
    state.successMessage = newSuccessMessage;
};

export const SET_CURRENT_PAGE_TITLE = (state, newPageTitle) => {
    state.currentPageTitle = newPageTitle;
};

export const SET_USER_PERMISSIONS = (state, userpermissions) => {
    state.userpermissions = userpermissions;
};
