import type { ReactNode } from "react";
import * as Dialog from "@radix-ui/react-dialog";

import { tw } from "~/utils";
import { icons } from "./Icons";

interface ModalProps {
  children?: ReactNode;
  className?: string;
  show: boolean;
  title: string;
  description?: string;
  onClose: () => void;
}

export const Modal = ({
  children,
  className,
  show,
  title,
  description,
  onClose,
}: ModalProps) => (
  <Dialog.Root open={show} onOpenChange={onClose}>
    <Dialog.Portal>
      <Dialog.Overlay className="data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 fixed inset-0 z-50 bg-gray-800/80 backdrop-blur-sm" />
      <Dialog.Content
        className={tw(
          "data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 data-[state=closed]:slide-out-to-left-1/2 data-[state=closed]:slide-out-to-top-[48%] data-[state=open]:slide-in-from-left-1/2 data-[state=open]:slide-in-from-top-[48%] fixed top-[50%] left-[50%] z-50 grid w-full max-w-lg translate-x-[-50%] translate-y-[-50%] gap-4 border border-gray-600 bg-gray-900 p-6 text-gray-50 shadow-lg duration-200 sm:rounded-lg",
          className,
        )}
      >
        <div className="flex flex-col space-y-1.5 text-center sm:text-left">
          <Dialog.Title className="text-lg leading-none font-semibold tracking-tight">
            {title}
          </Dialog.Title>

          <Dialog.Description className="text-sm text-gray-400">
            {description}
          </Dialog.Description>
        </div>

        {children}

        <Dialog.Close asChild>
          <button
            className="absolute top-4 right-4 rounded-sm opacity-70 ring-gray-400 transition-opacity hover:opacity-100 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:outline-none disabled:pointer-events-none data-[state=open]:bg-gray-800 data-[state=open]:text-gray-50"
            aria-label="Close"
          >
            <icons.XMarkIcon className="h-4 w-4" />

            <span className="sr-only">Close</span>
          </button>
        </Dialog.Close>
      </Dialog.Content>
    </Dialog.Portal>
  </Dialog.Root>
);
