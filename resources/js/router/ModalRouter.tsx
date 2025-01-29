import { useRef } from "react";
import { Route, Routes, useLocation, useNavigate } from "react-router-dom";
import { Transition, TransitionGroup } from "react-transition-group";

import { UserModal } from "~/modals";

export const ModalRouter = ({ showModal }: { showModal: boolean }) => {
  const navigate = useNavigate();
  const location = useLocation();
  const nodeRef = useRef(null);

  return (
    <TransitionGroup>
      <Transition key={location.pathname} timeout={600} nodeRef={nodeRef}>
        {(state) => {
          const show = state !== "exited" && state !== "exiting";

          if (!showModal) {
            return null;
          }

          const goBack = () => state !== "exiting" && navigate(-1);

          return (
            <div ref={nodeRef}>
              {/* TODO: deprecated */}
              <Routes location={location}>
                <Route
                  // path={`${MODAL_ROUTES.userForm}`}
                  element={<UserModal show={show} onClose={goBack} />}
                />
              </Routes>
            </div>
          );
        }}
      </Transition>
    </TransitionGroup>
  );
};
