import React, { forwardRef } from "react";
import type { ComponentProps, ElementRef } from "react";
import * as DialogPrimitive from "@radix-ui/react-dialog";

import { CloseIcon, tw } from "~/shared";

const Root = DialogPrimitive.Root;
Root.displayName = "Modal.Root";

const Trigger = DialogPrimitive.Trigger;
Trigger.displayName = "Modal.Trigger";
const Overlay = forwardRef<
  ElementRef<typeof DialogPrimitive.Overlay>,
  ComponentProps<typeof DialogPrimitive.Overlay>
>(({ className, ...props }, ref) => (
  <DialogPrimitive.Overlay
    ref={ref}
    className={tw(
      "data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 fixed inset-0 z-50 bg-black/60 backdrop-blur-sm",
      className,
    )}
    {...props}
  />
));
Overlay.displayName = "Modal.Overlay";

const CloseButton = forwardRef<
  ElementRef<typeof DialogPrimitive.Close>,
  ComponentProps<typeof DialogPrimitive.Close>
>(({ className, ...props }, ref) => (
  <DialogPrimitive.Close
    ref={ref}
    className={tw(
      "text-nature-10 absolute top-2.5 right-2.5 size-5 rounded-sm opacity-70 ring-gray-400 transition-opacity hover:opacity-100 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:outline-none disabled:pointer-events-none",
      className,
    )}
    {...props}
  >
    <CloseIcon />
    <span className="sr-only">Close</span>
  </DialogPrimitive.Close>
));
CloseButton.displayName = "Modal.CloseButton";

const Content = forwardRef<
  ElementRef<typeof DialogPrimitive.Content>,
  ComponentProps<typeof DialogPrimitive.Content>
>(({ className, children, ...props }, ref) => (
  <DialogPrimitive.Portal>
    <Overlay />
    <DialogPrimitive.Content
      ref={ref}
      className={tw(
        "bg-salmon-01 data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 data-[state=closed]:slide-out-to-left-1/2 data-[state=closed]:slide-out-to-top-[48%] data-[state=open]:slide-in-from-left-1/2 data-[state=open]:slide-in-from-top-[48%] fixed top-1/2 left-1/2 z-50 flex max-h-[calc(100dvh-2rem)] max-w-[calc(100dvw-2rem)] min-w-min -translate-x-1/2 -translate-y-1/2 flex-col overflow-hidden rounded-3xl text-gray-50 shadow-lg duration-200 sm:rounded-2xl",
        className,
      )}
      {...props}
    >
      {children}
    </DialogPrimitive.Content>
  </DialogPrimitive.Portal>
));
Content.displayName = DialogPrimitive.Content.displayName;

const Header = ({ className, ...props }: ComponentProps<"div">) => (
  <div
    className={tw(
      "flex flex-col gap-y-1.5 text-center sm:text-left",
      className,
    )}
    {...props}
  />
);
Header.displayName = "Modal.Header";

const Footer = ({ className, ...props }: ComponentProps<"div">) => (
  <div
    className={tw(
      "flex flex-col-reverse sm:flex-row sm:justify-end sm:gap-x-2",
      className,
    )}
    {...props}
  />
);
Footer.displayName = "Modal.Footer";

const Title = forwardRef<
  ElementRef<typeof DialogPrimitive.Title>,
  ComponentProps<typeof DialogPrimitive.Title>
>(({ className, ...props }, ref) => (
  <DialogPrimitive.Title
    ref={ref}
    className={tw(
      "text-salmon-10 truncate text-center font-serif text-2xl leading-10 md:text-left md:text-3xl",
      className,
    )}
    {...props}
  />
));
Title.displayName = "Modal.Title";

const Description = forwardRef<
  ElementRef<typeof DialogPrimitive.Description>,
  ComponentProps<typeof DialogPrimitive.Description>
>(({ className, ...props }, ref) => (
  <DialogPrimitive.Description
    ref={ref}
    className={tw("text-brown-09 leading-4.5 font-medium", className)}
    {...props}
  />
));
Description.displayName = "Modal.Description";

export {
  Root,
  Overlay,
  Trigger,
  CloseButton,
  Content,
  Header,
  Footer,
  Title,
  Description,
};
