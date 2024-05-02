export const transformInpData = (
  inpData: Partial<Record<'tSsr' | 'hda' | 'spa' | 'mSsr' | 'ssg', number>>,
) => {
  return Object.entries(inpData).reduce(
    (acc, [key, value]) => {
      acc[key as keyof typeof acc] = {
        numericValue: value,
        displayValue: `${value} ms`,
      }
      return acc
    },
    {} as Partial<
      Record<
        'tSsr' | 'hda' | 'spa' | 'mSsr' | 'ssg',
        { numericValue: number; displayValue: string }
      >
    >,
  )
}
